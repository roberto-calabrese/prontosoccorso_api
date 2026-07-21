<?php

namespace App\Jobs\Concerns;

use App\Services\ScrapeAlertNotifier;
use Throwable;

/**
 * Notifica automatica dei problemi di scraping, direttamente dentro il job così
 * da funzionare in QUALSIASI modalità (coda/redis via Horizon oppure sincrono).
 *
 * Copre due casi:
 *  - failed(): eccezione del job. Laravel lo invoca dentro Job::fail(), prima
 *    dei listener dell'evento JobFailed, quindi è indipendente dall'ordine dei
 *    listener di Horizon e dallo stato dello storage dei failed_jobs.
 *  - reportIfScrapeEmpty(): lo scrape non ha prodotto dati validi (es. selettori
 *    o struttura della pagina cambiati). Va chiamato dentro handle() prima di
 *    trasmettere/ritornare i dati, perché in modalità async il risultato non
 *    torna a GenericDataService.
 *
 * Richiede che la classe abbia una property `protected array $config`.
 */
trait AlertsOnScrapeFailure
{
    /**
     * Invocato da Laravel quando il job fallisce con un'eccezione.
     */
    public function failed(Throwable $e): void
    {
        $this->notifyScrapeAlert(
            reason: 'Il job di scraping è fallito con un\'eccezione',
            e: $e,
        );
    }

    /**
     * Da chiamare in handle() prima del broadcast: se lo scrape non ha prodotto
     * dati validi invia l'alert.
     */
    protected function reportIfScrapeEmpty(?array $ospedali): void
    {
        if (ScrapeAlertNotifier::resultLooksEmpty($ospedali)) {
            $this->notifyScrapeAlert(reason: 'Lo scraping non ha restituito dati validi');
        }
    }

    private function notifyScrapeAlert(string $reason, ?Throwable $e = null): void
    {
        $config = $this->config ?? [];

        app(ScrapeAlertNotifier::class)->report(
            source: $config['cache']['key'] ?? static::class,
            reason: $reason,
            e: $e,
            context: [
                'jobClass' => static::class,
                'url' => $config['url'] ?? null,
            ],
        );
    }
}
