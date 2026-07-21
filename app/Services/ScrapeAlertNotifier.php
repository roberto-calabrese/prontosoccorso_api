<?php

namespace App\Services;

use App\Mail\ScrapeFailed;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Invia (con throttling) una email quando uno scraping fallisce o non
 * restituisce dati. Usato dal trait AlertsOnScrapeFailure (dentro i job, quindi
 * sia in coda/redis che in sincrono) e dal path sincrono di GenericDataService.
 */
class ScrapeAlertNotifier
{
    /**
     * Segnala un problema di scraping.
     *
     * @param string      $source   Identificativo della sorgente (es. sicilia.agrigento.aspAgrigento)
     * @param string      $reason   Motivo leggibile
     * @param Throwable|null $e      Eventuale eccezione
     * @param array       $context  Dati extra: 'jobClass', 'url'
     */
    public function report(string $source, string $reason, ?Throwable $e = null, array $context = []): void
    {
        $recipient = config('services.scrape_alert.email');

        if (empty($recipient)) {
            return;
        }

        // Throttling: una sola email per sorgente entro la finestra di cooldown.
        $cooldown = (int) config('services.scrape_alert.cooldown_minutes', 30);
        $throttleKey = 'scrape_alert:sent:' . md5($source);

        if (!Cache::add($throttleKey, true, now()->addMinutes($cooldown))) {
            return;
        }

        $details = $e
            ? $e->getMessage() . ' (' . $e->getFile() . ':' . $e->getLine() . ')'
            : null;

        Log::warning('Scraping alert', [
            'source' => $source,
            'reason' => $reason,
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
     * (selettori non più validi). Gli zeri sono dati validi e NON scatenano
     * l'allarme (pronto soccorso realmente scarico); 'extra' e 'totali' sono
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
