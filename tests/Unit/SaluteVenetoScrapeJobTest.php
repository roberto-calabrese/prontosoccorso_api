<?php

namespace Tests\Unit;

use App\Jobs\Veneto\SaluteVenetoScrapeJob;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * Il portale veneto e' gia' cambiato due volte sotto ai piedi: il form ora
 * pretende la provincia e la tabella interna ha un <tbody> implicito che
 * faceva fallire i vecchi selettori posizionali. Questi test lavorano su una
 * pagina salvata, cosi' verificano il parsing senza dipendere dalla rete.
 */
class SaluteVenetoScrapeJobTest extends TestCase
{
    private function job(array $data = []): SaluteVenetoScrapeJob
    {
        return new SaluteVenetoScrapeJob([], [
            'cache' => ['key' => 'test.veneto', 'ttlMinute' => 1],
            'url' => 'https://esempio.test/',
            'method' => 'POST',
            'form_params' => ['provincia' => 'BL'],
            'headers' => [],
            'data' => $data,
        ]);
    }

    private function invoca(SaluteVenetoScrapeJob $job, string $metodo, ...$argomenti)
    {
        $riflesso = new ReflectionMethod($job, $metodo);
        $riflesso->setAccessible(true);

        return $riflesso->invoke($job, ...$argomenti);
    }

    private function pagina(string $file): string
    {
        return file_get_contents(__DIR__ . '/../Fixtures/' . $file);
    }

    public function test_legge_tutte_le_strutture_della_pagina(): void
    {
        $righe = $this->invoca($this->job(), 'leggiPagina', $this->pagina('veneto-belluno.html'));

        $this->assertCount(5, $righe);
        $this->assertArrayHasKey('pronto soccorso belluno', $righe);
        $this->assertSame('ULSS 501', $righe['pronto soccorso belluno']['ulss']);
        $this->assertSame(
            'Viale Europa, 22, Belluno, 32100, BL',
            $righe['pronto soccorso belluno']['indirizzo']
        );
    }

    public function test_distingue_pazienti_in_attesa_da_quelli_in_visita(): void
    {
        $righe = $this->invoca($this->job(), 'leggiPagina', $this->pagina('veneto-belluno.html'));
        $valori = $righe['pronto soccorso belluno']['valori'];

        // Le due righe di numeri si distinguono solo dall'icona: se il job le
        // confondesse, attesa e visita risulterebbero scambiate.
        $this->assertSame(
            ['rosso' => 0, 'arancione' => 0, 'giallo' => 0, 'verde' => 0, 'bianco' => 2],
            $valori['attesa']
        );
        $this->assertSame(
            ['rosso' => 0, 'arancione' => 6, 'giallo' => 1, 'verde' => 1, 'bianco' => 4],
            $valori['visita']
        );
    }

    public function test_i_contatori_sommano_i_colori_nei_totali(): void
    {
        $righe = $this->invoca($this->job(), 'leggiPagina', $this->pagina('veneto-belluno.html'));
        $dati = $this->invoca($this->job(), 'contatori', $righe['pronto soccorso belluno']);

        $this->assertSame(2, $dati['totali']['value']);
        $this->assertSame(2, $dati['totali']['extra']['in_attesa']['value']);
        $this->assertSame(12, $dati['totali']['extra']['in_trattamento']['value']);

        // il valore principale di ogni colore e' il numero in attesa
        $this->assertSame(2, $dati['bianco']['value']);
        $this->assertSame(4, $dati['bianco']['extra']['in_trattamento']['value']);

        $somma = 0;
        foreach (['rosso', 'arancione', 'giallo', 'verde', 'bianco'] as $colore) {
            $somma += $dati[$colore]['extra']['in_attesa']['value'];
        }
        $this->assertSame($dati['totali']['value'], $somma);
    }

    public function test_riporta_l_ultimo_aggiornamento_nel_formato_italiano(): void
    {
        $righe = $this->invoca($this->job(), 'leggiPagina', $this->pagina('veneto-belluno.html'));
        $dati = $this->invoca($this->job(), 'contatori', $righe['pronto soccorso belluno']);

        $this->assertSame('08/09/2026 08:30', $dati['extra']['ultimo_aggiornamento']['value']);
    }

    public function test_l_abbinamento_ignora_maiuscole_e_spazi_doppi(): void
    {
        $job = $this->job();

        $this->assertSame(
            $this->invoca($job, 'normalizza', 'Pronto Soccorso Belluno'),
            $this->invoca($job, 'normalizza', "  pronto   SOCCORSO  belluno ")
        );
    }

    public function test_una_pagina_contiene_al_massimo_cinque_strutture(): void
    {
        // Il portale pagina a cinque: se cambiasse, il job scaricherebbe
        // comunque le pagine successive, ma e' bene accorgersene.
        $righe = $this->invoca($this->job(), 'leggiPagina', $this->pagina('veneto-venezia-pagina1.html'));

        $this->assertCount(5, $righe);
        $this->assertArrayHasKey('pronto soccorso dolo', $righe);
    }

    public function test_pagina_senza_risultati_non_produce_righe(): void
    {
        $righe = $this->invoca($this->job(), 'leggiPagina', '<html><body><p>nessun risultato</p></body></html>');

        $this->assertSame([], $righe);
    }
}
