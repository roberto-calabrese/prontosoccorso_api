<?php

namespace App\Jobs\Concerns;

use App\Services\ScrapeAlertNotifier;
use Throwable;

/**
 * Notifica dei problemi di scraping con criterio a "soglia su finestra"
 * (gestito da ScrapeAlertNotifier): la mail parte solo se una sorgente accumula
 * troppi fallimenti entro la finestra configurata; un recupero riuscito azzera
 * il contatore. Funziona in QUALSIASI modalità (coda/redis via Horizon o sync).
 *
 * Copre:
 *  - failed(): eccezione del job. Laravel lo invoca dentro Job::fail(), prima
 *    dei listener dell'evento JobFailed, quindi è indipendente dall'ordine dei
 *    listener di Horizon e dallo stato dello storage dei failed_jobs.
 *  - trackScrapeOutcome(): da chiamare in handle() prima del broadcast. Se lo
 *    scrape ha prodotto dati validi azzera il contatore, altrimenti registra un
 *    fallimento (in modalità async il risultato non torna a GenericDataService).
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
        app(ScrapeAlertNotifier::class)->recordFailure(
            source: $this->scrapeAlertSource(),
            reason: 'Il job di scraping è fallito con un\'eccezione',
            e: $e,
            context: $this->scrapeAlertContext(),
        );
    }

    /**
     * Da chiamare in handle() prima del broadcast: registra l'esito dello scrape
     * (successo -> reset del contatore, dati vuoti -> fallimento).
     */
    protected function trackScrapeOutcome(?array $ospedali): void
    {
        $notifier = app(ScrapeAlertNotifier::class);

        if (ScrapeAlertNotifier::resultLooksEmpty($ospedali)) {
            $notifier->recordFailure(
                source: $this->scrapeAlertSource(),
                reason: 'Lo scraping non ha restituito dati validi',
                context: $this->scrapeAlertContext(),
            );

            return;
        }

        $notifier->recordSuccess($this->scrapeAlertSource());
    }

    private function scrapeAlertSource(): string
    {
        return $this->config['cache']['key'] ?? static::class;
    }

    private function scrapeAlertContext(): array
    {
        return [
            'jobClass' => static::class,
            'url' => $this->config['url'] ?? null,
        ];
    }
}
