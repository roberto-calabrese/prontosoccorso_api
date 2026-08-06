<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScrapeFailed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param string      $source  Sorgente che ha generato il problema (es. sicilia.agrigento.aspAgrigento)
     * @param string      $reason  Motivo leggibile (eccezione o "nessun dato")
     * @param string|null $jobClass Classe del job coinvolto
     * @param string|null $url     URL della fonte dati
     * @param string|null $details Dettaglio tecnico (messaggio + file:linea)
     */
    public function __construct(
        public string $source,
        public string $reason,
        public ?string $jobClass = null,
        public ?string $url = null,
        public ?string $details = null,
        public ?int $failureCount = null,
        public ?int $windowMinutes = null,
    ) {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Scraping fallito - ' . $this->source . ' | Pronto Soccorso Live',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.scrape-failed',
            with: [
                'occurredAt' => now()->timezone('Europe/Rome')->format('d/m/Y H:i:s'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
