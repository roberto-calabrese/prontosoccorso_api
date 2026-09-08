<?php

namespace App\Jobs\Veneto;

use App\Events\PusherEvent;
use App\Jobs\Concerns\AlertsOnScrapeFailure;
use App\Jobs\Concerns\HasHttpTimeouts;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Portale della Regione Veneto: il form richiede obbligatoriamente la provincia
 * e restituisce i presidi cinque per pagina.
 *
 * Gli ospedali vengono abbinati alla riga tramite il campo 'codice', che
 * contiene il nome pubblicato dal portale. Prima l'abbinamento era posizionale
 * (n-esima riga = n-esimo ospedale in configurazione): bastava che il portale
 * aggiungesse o togliesse un presidio perche' tutti i dati successivi
 * scivolassero sull'ospedale sbagliato, senza alcun errore visibile.
 */
class SaluteVenetoScrapeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AlertsOnScrapeFailure, HasHttpTimeouts;

    /**
     * Colore interno -> classe CSS della cella. Il Veneto usa il giallo
     * al posto dell'azzurro.
     */
    protected const COLORI = [
        'rosso' => 'psRosso',
        'arancione' => 'psArancione',
        'giallo' => 'psGiallo',
        'verde' => 'psVerde',
        'bianco' => 'psBianco',
    ];

    /**
     * Limite di sicurezza: se il portale ignorasse il parametro di pagina
     * continuerebbe a restituire sempre la prima, quindi oltre a questo tetto
     * c'e' anche il controllo sulla ripetizione delle righe.
     */
    protected const MAX_PAGINE = 10;

    protected array $websocket;

    protected array $config;

    public function __construct(array $websocket, array $config)
    {
        $this->websocket = $websocket;
        $this->config = $config;
    }

    public function handle()
    {
        $cacheKey = $this->config['cache']['key'];
        $cacheTTL = $this->config['cache']['ttlMinute'];

        $lockKey = "lock:{$cacheKey}";

        if (!Cache::add($lockKey, true, $cacheTTL)) {
            return 0;
        }

        return Cache::remember($cacheKey, now()->addMinutes($cacheTTL), function () {

            $righe = $this->scaricaProvincia();

            $ospedali = [];

            foreach ($this->config['data'] as $keyH => $ospedale) {
                $riga = $righe[$this->normalizza($ospedale['codice'])] ?? null;

                // Presidio non piu' pubblicato: meglio non esporre nulla che
                // esporre zeri, che verrebbero letti come "nessuno in attesa".
                if ($riga === null) {
                    continue;
                }

                $ospedali[$keyH]['data'] = $this->contatori($riga);
            }

            $this->trackScrapeOutcome($ospedali);

            if ($this->websocket) {
                event(new PusherEvent($ospedali, [
                    'channel' => $this->websocket['channel'],
                    'event' => $this->websocket['event']
                ]));
            }

            return $ospedali;

        });
    }

    /**
     * Scorre le pagine della provincia e restituisce le righe indicizzate
     * per nome normalizzato.
     *
     * @return array<string, array<string, mixed>>
     */
    protected function scaricaProvincia(): array
    {
        $client = new Client($this->httpClientOptions());

        $righe = [];

        for ($pagina = 1; $pagina <= self::MAX_PAGINE; $pagina++) {

            $url = $pagina === 1
                ? $this->config['url']
                : $this->config['url'] . '&page=' . $pagina;

            $response = $client->request($this->config['method'] ?? 'POST', $url, [
                'headers' => $this->config['headers'],
                'form_params' => $this->config['form_params'],
                'verify' => false,
            ]);

            $trovate = $this->leggiPagina($response->getBody()->getContents());

            if (!$trovate) {
                break;
            }

            // Se la pagina ripete righe gia' viste il portale sta ignorando il
            // parametro: inutile continuare a chiedere.
            $nuove = array_diff_key($trovate, $righe);

            if (!$nuove) {
                break;
            }

            $righe += $nuove;
        }

        return $righe;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    protected function leggiPagina(string $html): array
    {
        $righe = [];

        (new Crawler($html))->filter('table#ps>tbody>tr')->each(function (Crawler $tr) use (&$righe) {
            $nome = $this->testo($tr, '.psNomePs');

            if ($nome === '') {
                return;
            }

            $righe[$this->normalizza($nome)] = [
                'nome' => $nome,
                'ulss' => $this->testo($tr, '.psUlss'),
                'indirizzo' => $this->testo($tr, '.psIndirizzo'),
                'aggiornamento' => $this->testo($tr, '.psUltimoAggiornamento'),
                'valori' => $this->leggiValori($tr),
            ];
        });

        return $righe;
    }

    /**
     * Le due righe di numeri si riconoscono dall'icona: in-attesa / in-visita.
     *
     * @return array{attesa: array<string, int>, visita: array<string, int>}
     */
    protected function leggiValori(Crawler $tr): array
    {
        $valori = ['attesa' => [], 'visita' => []];

        $tr->filter('td:nth-child(3) table tr')->each(function (Crawler $riga) use (&$valori) {
            $img = $riga->filter('img');

            if (!$img->count()) {
                return;
            }

            $tipo = str_contains($img->attr('src') ?? '', 'in-attesa') ? 'attesa' : 'visita';

            foreach (self::COLORI as $colore => $classe) {
                $cella = $riga->filter("td.$classe");
                $valori[$tipo][$colore] = $cella->count() ? (int) trim($cella->first()->text('')) : 0;
            }
        });

        return $valori;
    }

    /**
     * Contatori nel formato usato dal resto dell'applicazione.
     */
    protected function contatori(array $riga): array
    {
        $contatori = [];
        $totaleAttesa = 0;
        $totaleVisita = 0;

        foreach (array_keys(self::COLORI) as $colore) {
            $attesa = $riga['valori']['attesa'][$colore] ?? 0;
            $visita = $riga['valori']['visita'][$colore] ?? 0;

            $totaleAttesa += $attesa;
            $totaleVisita += $visita;

            $contatori[$colore] = [
                'value' => $attesa,
                'extra' => [
                    'in_attesa' => [
                        'label' => 'Pazienti in attesa',
                        'value' => $attesa,
                    ],
                    'in_trattamento' => [
                        'label' => 'Pazienti in visita',
                        'value' => $visita,
                    ],
                ],
            ];
        }

        $contatori['totali'] = [
            'value' => $totaleAttesa,
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'value' => $totaleAttesa,
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in visita',
                    'value' => $totaleVisita,
                ],
            ],
        ];

        $contatori['extra'] = [
            'ultimo_aggiornamento' => [
                'label' => 'Ultimo aggiornamento',
                'value' => $this->formattaData($riga['aggiornamento'] ?? ''),
            ],
        ];

        return $contatori;
    }

    /**
     * Il portale pubblica "2026-09-08 08:30:00": lo riporto nel formato
     * usato dalle altre regioni.
     */
    protected function formattaData(string $valore): ?string
    {
        if (trim($valore) === '') {
            return null;
        }

        try {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', trim($valore))->format('d/m/Y H:i');
        } catch (\Throwable) {
            return $valore;
        }
    }

    protected function testo(Crawler $nodo, string $selettore): string
    {
        $trovato = $nodo->filter($selettore);

        return $trovato->count() ? trim(preg_replace('/\s+/u', ' ', $trovato->first()->text(''))) : '';
    }

    protected function normalizza(string $testo): string
    {
        $testo = str_replace(["\u{2019}", "\u{2018}", "\u{00A0}"], ["'", "'", ' '], $testo);

        return trim(preg_replace('/\s+/u', ' ', mb_strtolower($testo)));
    }
}
