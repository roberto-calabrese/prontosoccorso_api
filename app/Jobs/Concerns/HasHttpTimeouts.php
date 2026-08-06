<?php

namespace App\Jobs\Concerns;

/**
 * Opzioni comuni per il client HTTP dei job di scraping.
 *
 * Senza timeout espliciti Guzzle attende senza limite: e' successo con il
 * portale degli Ospedali Riuniti di Palermo, che ha smesso di rispondere
 * tenendo bloccati tutti i worker e, di conseguenza, fermando lo scraping di
 * ogni provincia. Con i timeout il job fallisce in fretta, la notifica parte e
 * la coda continua a scorrere.
 *
 * @see config/scraping.php per i valori
 */
trait HasHttpTimeouts
{
    /**
     * Opzioni di default del client, sovrascrivibili dal chiamante.
     */
    protected function httpClientOptions(array $options = []): array
    {
        return $options + [
            'connect_timeout' => config('scraping.connect_timeout'),
            'timeout' => config('scraping.timeout'),
        ];
    }
}
