<?php

namespace App\Console\Commands;

use App\Mail\ScrapeCheckReport;
use App\Services\ScrapeAlertNotifier;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Controllo periodico di tutte le sorgenti di scraping.
 *
 * A differenza dell'alert in tempo reale (ScrapeAlertNotifier, che scatta solo
 * quando una singola sorgente accumula troppi fallimenti), qui si interrogano
 * tutte le sorgenti una per una e si manda un unico riepilogo con l'esito
 * completo: utile per accorgersi dei portali che cambiano struttura senza far
 * rumore, come e' gia' successo con Veneto e Puglia.
 */
class ScrapeCheckCommand extends Command
{
    protected $signature = 'scrape:check
                            {--regione= : Controlla solo questa regione (es. veneto)}
                            {--provincia= : Controlla solo questa provincia (richiede --regione)}
                            {--tentativi=2 : Quante volte riprovare una sorgente prima di darla per fallita}
                            {--no-mail : Non inviare il riepilogo via email}';

    protected $description = 'Verifica tutte le sorgenti di scraping e invia un riepilogo via email';

    public function handle(): int
    {
        $sorgenti = $this->sorgenti();

        if (!$sorgenti) {
            $this->error('Nessuna sorgente da controllare con i filtri indicati.');

            return self::FAILURE;
        }

        $this->info(sprintf('Controllo di %d sorgenti...', count($sorgenti)));

        $esiti = [];
        $barra = $this->output->createProgressBar(count($sorgenti));
        $barra->start();

        foreach ($sorgenti as $sorgente) {
            $esiti[] = $this->controlla($sorgente);
            $barra->advance();
        }

        $barra->finish();
        $this->newLine(2);

        $this->mostraTabella($esiti);

        $riepilogo = $this->riepilogo($esiti);

        Log::info('Controllo scraping completato', $riepilogo);

        if (!$this->option('no-mail')) {
            $this->invia($esiti, $riepilogo);
        }

        // Codice di uscita diverso da zero se qualcosa non va: cosi' anche il
        // cron o un monitor esterno se ne accorgono senza leggere la mail.
        return $riepilogo['falliti'] > 0 ? self::FAILURE : self::SUCCESS;
    }

    /**
     * Elenco delle sorgenti dichiarate in configurazione, con i filtri applicati.
     */
    protected function sorgenti(): array
    {
        $filtroRegione = $this->option('regione');
        $filtroProvincia = $this->option('provincia');

        $sorgenti = [];

        foreach (config('regioni') as $regione => $province) {
            if ($filtroRegione && $regione !== $filtroRegione) {
                continue;
            }

            foreach ($province as $provincia => $configProvincia) {
                if ($filtroProvincia && $provincia !== $filtroProvincia) {
                    continue;
                }

                foreach ($configProvincia['ospedali'] ?? [] as $gruppo => $config) {
                    $sorgenti[] = [
                        'regione' => $regione,
                        'provincia' => $provincia,
                        'gruppo' => $gruppo,
                        'config' => $config,
                    ];
                }
            }
        }

        return $sorgenti;
    }

    /**
     * Controlla una sorgente, riprovando prima di darla per persa.
     *
     * Il secondo tentativo non e' pignoleria: un giro completo tocca decine di
     * portali e un singolo intoppo di rete faceva risultare KO mezza Italia,
     * rendendo il riepilogo inaffidabile e quindi ignorabile.
     */
    protected function controlla(array $sorgente): array
    {
        $tentativi = max(1, (int) $this->option('tentativi'));

        for ($tentativo = 1; $tentativo <= $tentativi; $tentativo++) {
            $esito = $this->tentativo($sorgente);
            $esito['tentativi'] = $tentativo;

            if ($esito['stato'] !== 'fallito' || $tentativo === $tentativi) {
                return $esito;
            }

            sleep(2);
        }

        return $esito;
    }

    /**
     * Esegue il job della sorgente una volta e ne classifica l'esito.
     */
    protected function tentativo(array $sorgente): array
    {
        $config = $sorgente['config'];
        $attesi = count($config['data'] ?? []);

        $esito = [
            'sorgente' => $config['cache']['key'] ?? "{$sorgente['regione']}.{$sorgente['provincia']}.{$sorgente['gruppo']}",
            'regione' => $sorgente['regione'],
            'provincia' => $sorgente['provincia'],
            'job' => class_basename($config['jobClass'] ?? '?'),
            'url' => $config['url'] ?? null,
            'attesi' => $attesi,
            'conDati' => 0,
            'durata' => 0.0,
            'stato' => 'fallito',
            'motivo' => null,
            'tentativi' => 1,
        ];

        if (empty($config['jobClass']) || !class_exists($config['jobClass'])) {
            $esito['motivo'] = 'jobClass mancante o inesistente';

            return $esito;
        }

        // Cache e lock vanno azzerati, altrimenti il job restituirebbe il valore
        // gia' in cache (o si fermerebbe sul lock) senza interrogare la fonte:
        // il controllo non verificherebbe nulla.
        $this->svuotaCache($config);

        $inizio = microtime(true);

        try {
            // Websocket vuoto: il controllo non deve trasmettere nulla ai client.
            $risultato = (new $config['jobClass']([], $config))->handle();
        } catch (Throwable $e) {
            $esito['durata'] = round(microtime(true) - $inizio, 2);
            $esito['motivo'] = $this->motivoLeggibile($e);

            return $esito;
        }

        $esito['durata'] = round(microtime(true) - $inizio, 2);

        if (!is_array($risultato)) {
            $esito['motivo'] = 'il job non ha restituito dati';

            return $esito;
        }

        foreach ($config['data'] ?? [] as $key => $ospedale) {
            if (isset($risultato[$key]) && ScrapeAlertNotifier::ospedaleHaDati($risultato[$key])) {
                $esito['conDati']++;
            }
        }

        if ($esito['conDati'] === 0) {
            $esito['motivo'] = 'nessun ospedale con valori validi';
            $esito['stato'] = 'fallito';
        } elseif ($esito['conDati'] < $attesi) {
            $mancanti = $attesi - $esito['conDati'];
            $esito['motivo'] = sprintf(
                '%d %s su %d senza dati',
                $mancanti,
                $mancanti === 1 ? 'ospedale' : 'ospedali',
                $attesi
            );
            $esito['stato'] = 'parziale';
        } else {
            $esito['stato'] = 'ok';
        }

        return $esito;
    }

    protected function svuotaCache(array $config): void
    {
        $chiave = $config['cache']['key'] ?? null;

        if (!$chiave) {
            return;
        }

        Cache::forget($chiave);
        Cache::forget("lock:$chiave");
    }

    protected function motivoLeggibile(Throwable $e): string
    {
        $messaggio = trim($e->getMessage());

        // I messaggi di Guzzle contengono l'intero corpo della risposta.
        if (mb_strlen($messaggio) > 200) {
            $messaggio = mb_substr($messaggio, 0, 200) . '...';
        }

        return class_basename($e) . ': ' . $messaggio;
    }

    /**
     * @param array<int, array<string, mixed>> $esiti
     */
    protected function riepilogo(array $esiti): array
    {
        $conta = static fn(string $stato): int => count(array_filter($esiti, static fn($e) => $e['stato'] === $stato));

        return [
            'sorgenti' => count($esiti),
            'ok' => $conta('ok'),
            'parziali' => $conta('parziale'),
            'falliti' => $conta('fallito'),
            'ospedaliAttesi' => array_sum(array_column($esiti, 'attesi')),
            'ospedaliConDati' => array_sum(array_column($esiti, 'conDati')),
            'durata' => round(array_sum(array_column($esiti, 'durata')), 1),
        ];
    }

    /**
     * @param array<int, array<string, mixed>> $esiti
     */
    protected function mostraTabella(array $esiti): void
    {
        $problemi = array_filter($esiti, static fn($e) => $e['stato'] !== 'ok');

        if ($problemi) {
            $this->error(sprintf('%d sorgenti con problemi:', count($problemi)));
            $this->table(
                ['Stato', 'Sorgente', 'Ospedali', 'Sec.', 'Tent.', 'Motivo'],
                array_map(static fn($e) => [
                    $e['stato'] === 'fallito' ? 'FALLITO' : 'PARZIALE',
                    $e['sorgente'],
                    "{$e['conDati']}/{$e['attesi']}",
                    $e['durata'],
                    $e['tentativi'] ?? 1,
                    $e['motivo'],
                ], $problemi)
            );
        }

        $riepilogo = $this->riepilogo($esiti);

        $this->line(sprintf(
            '<info>%d ok</info>, <comment>%d parziali</comment>, <fg=red>%d falliti</> su %d sorgenti | %d/%d ospedali con dati | %.1fs',
            $riepilogo['ok'], $riepilogo['parziali'], $riepilogo['falliti'], $riepilogo['sorgenti'],
            $riepilogo['ospedaliConDati'], $riepilogo['ospedaliAttesi'], $riepilogo['durata']
        ));
    }

    protected function invia(array $esiti, array $riepilogo): void
    {
        $destinatario = config('services.scrape_alert.email');

        if (empty($destinatario)) {
            $this->warn('Nessun destinatario configurato (SCRAPE_ALERT_EMAIL): riepilogo non inviato.');

            return;
        }

        try {
            Mail::to($destinatario)->send(new ScrapeCheckReport($esiti, $riepilogo));
            $this->info("Riepilogo inviato a {$destinatario}");
        } catch (Throwable $e) {
            $this->error('Invio del riepilogo fallito: ' . $e->getMessage());
            Log::error('Invio riepilogo controllo scraping fallito', ['error' => $e->getMessage()]);
        }
    }
}
