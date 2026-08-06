<?php

namespace App\Services;

use App\Mail\ScrapeFailed;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Gestisce le notifiche di scraping fallito con un criterio a "soglia su
 * finestra": la mail parte solo quando una sorgente accumula N fallimenti
 * (eccezione o dati non validi) entro una finestra di W minuti. Un singolo
 * recupero riuscito azzera il contatore. Questo evita email per fallimenti
 * transitori (che si risolvono al ciclo successivo).
 *
 * Usato dal trait AlertsOnScrapeFailure (dentro i job, quindi sia in coda/redis
 * che in sincrono) e dal path sincrono di GenericDataService.
 */
class ScrapeAlertNotifier
{
    /**
     * Registra un fallimento per la sorgente e invia la mail se viene
     * raggiunta la soglia entro la finestra configurata.
     *
     * @param string         $source  Identificativo della sorgente (es. sicilia.agrigento.aspAgrigento)
     * @param string         $reason  Motivo leggibile dell'ultimo fallimento
     * @param Throwable|null  $e       Eventuale eccezione
     * @param array          $context Dati extra: 'jobClass', 'url'
     */
    public function recordFailure(string $source, string $reason, ?Throwable $e = null, array $context = []): void
    {
        if (empty(config('services.scrape_alert.email'))) {
            return;
        }

        $threshold = max(1, (int) config('services.scrape_alert.threshold', 20));
        $window = max(1, (int) config('services.scrape_alert.window_minutes', 30));
        $key = $this->counterKey($source);

        // Contatore a finestra fissa: il TTL parte dal primo fallimento e viene
        // preservato dagli incrementi (Redis INCR non tocca la scadenza).
        if (Cache::has($key)) {
            $count = (int) Cache::increment($key);
        } else {
            Cache::put($key, 1, now()->addMinutes($window));
            $count = 1;
        }

        Log::debug('Scrape failure counter', [
            'source' => $source,
            'count' => $count,
            'threshold' => $threshold,
            'window_minutes' => $window,
        ]);

        // Invia una sola volta, esattamente al raggiungimento della soglia.
        // I fallimenti successivi non re-inviano finché la finestra non scade
        // (contatore azzerato) o non arriva un recupero riuscito.
        if ($count === $threshold) {
            $this->send($source, $reason, $e, $context, $count, $window);
        }
    }

    /**
     * Un recupero riuscito azzera il contatore dei fallimenti della sorgente.
     */
    public function recordSuccess(string $source): void
    {
        Cache::forget($this->counterKey($source));
    }

    protected function counterKey(string $source): string
    {
        return 'scrape_alert:fails:' . md5($source);
    }

    /**
     * Invio effettivo della mail di alert.
     */
    protected function send(string $source, string $reason, ?Throwable $e, array $context, int $failureCount, int $windowMinutes): void
    {
        $recipient = config('services.scrape_alert.email');

        $details = $e
            ? $e->getMessage() . ' (' . $e->getFile() . ':' . $e->getLine() . ')'
            : null;

        Log::warning('Scraping alert', [
            'source' => $source,
            'reason' => $reason,
            'failureCount' => $failureCount,
            'windowMinutes' => $windowMinutes,
            'jobClass' => $context['jobClass'] ?? null,
            'exception' => $details,
        ]);

        try {
            Mail::to($recipient)->send(new ScrapeFailed(
                source: $source,
                reason: $reason,
                jobClass: $context['jobClass'] ?? null,
                url: $context['url'] ?? null,
                details: $details,
                failureCount: $failureCount,
                windowMinutes: $windowMinutes,
            ));
        } catch (Throwable $mailError) {
            Log::error('Invio email alert scraping fallito', [
                'source' => $source,
                'error' => $mailError->getMessage(),
            ]);
        }
    }

    /**
     * Determina se un risultato di scraping è di fatto vuoto: nessun ospedale
     * oppure, per ogni ospedale, nessun valore numerico tra i codici colore
     * (selettori non più validi). Gli zeri sono dati validi e NON contano come
     * fallimento (pronto soccorso realmente scarico); 'extra' e 'totali' sono
     * derivati e vengono ignorati.
     */
    public static function resultLooksEmpty($ospedali): bool
    {
        if (!is_array($ospedali) || empty($ospedali)) {
            return true;
        }

        foreach ($ospedali as $ospedale) {
            $colori = $ospedale['data'] ?? [];

            foreach ($colori as $chiave => $valore) {
                if ($chiave === 'extra' || $chiave === 'totali') {
                    continue;
                }

                if (isset($valore['value']) && is_numeric($valore['value'])) {
                    return false;
                }
            }
        }

        return true;
    }
}
