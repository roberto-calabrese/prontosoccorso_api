<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Riepilogo del controllo periodico di tutte le sorgenti di scraping.
 *
 * @param array<int, array<string, mixed>> $esiti     Esito per sorgente
 * @param array<string, mixed>             $riepilogo Conteggi complessivi
 */
class ScrapeCheckReport extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $esiti,
        public array $riepilogo,
    ) {
    }

    public function envelope(): Envelope
    {
        $falliti = $this->riepilogo['falliti'] ?? 0;
        $parziali = $this->riepilogo['parziali'] ?? 0;

        // L'oggetto dice subito se serve intervenire: la mail arriva ogni 12 ore
        // e senza questo si finirebbe per non aprirla piu'.
        $plurale = static fn(int $n, string $singolare, string $plurale): string =>
            $n . ' ' . ($n === 1 ? $singolare : $plurale);

        $stato = match (true) {
            $falliti > 0 => '⚠️ ' . $plurale($falliti, 'sorgente KO', 'sorgenti KO'),
            $parziali > 0 => $plurale($parziali, 'sorgente parziale', 'sorgenti parziali'),
            default => 'tutto ok',
        };

        return new Envelope(
            subject: "Controllo scraping ({$stato}) | Pronto Soccorso Live",
        );
    }

    public function content(): Content
    {
        $per = fn(string $stato): array => array_values(
            array_filter($this->esiti, static fn($e) => $e['stato'] === $stato)
        );

        return new Content(
            view: 'emails.scrape-check',
            with: [
                'falliti' => $per('fallito'),
                'parziali' => $per('parziale'),
                'riusciti' => $per('ok'),
                'eseguitoIl' => now()->timezone('Europe/Rome')->format('d/m/Y H:i'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
