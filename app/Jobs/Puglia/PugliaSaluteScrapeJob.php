<?php

namespace App\Jobs\Puglia;

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
 * Portale PugliaSalute: una pagina Liferay elenca i pronto soccorso di una
 * provincia, uno per card. Ogni card riporta il nome del PS e quattro righe di
 * "chip", una per metrica, con un valore per codice colore.
 *
 * Gli ospedali in configurazione vengono abbinati alla card tramite il campo
 * 'codice', che contiene il titolo cosi' come lo pubblica il portale: e' l'unico
 * identificativo disponibile, nel markup non ci sono id di struttura.
 */
class PugliaSaluteScrapeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AlertsOnScrapeFailure, HasHttpTimeouts;

    /**
     * Classe del chip -> colore interno. Il portale non scrive il nome del
     * codice colore da nessuna parte: l'unico riferimento e' la classe CSS.
     */
    protected const COLORI = [
        'chip-danger' => 'rosso',
        'chip-warning' => 'arancione',
        'chip-info' => 'azzurro',
        'chip-success' => 'verde',
        'chip-secondary' => 'bianco',
    ];

    /**
     * Intestazione della riga sulla card -> chiave interna.
     */
    protected const SEZIONI = [
        'n. pazienti in attesa' => 'in_attesa',
        'n. pazienti in visita' => 'in_trattamento',
        'n. pazienti trattati nelle ultime 8 ore' => 'trattati_8h',
        'tempo medio di attesa (minuti)' => 'tempo_medio_attesa',
    ];

    protected const ETICHETTE = [
        'in_attesa' => 'Pazienti in attesa',
        'in_trattamento' => 'Pazienti in visita',
        'trattati_8h' => 'Pazienti trattati nelle ultime 8 ore',
        'tempo_medio_attesa' => 'Tempo medio di attesa (minuti)',
    ];

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
        $method = $this->config['method'] ?? 'GET';

        $lockKey = "lock:{$cacheKey}";

        if (!Cache::add($lockKey, true, $cacheTTL)) {
            return 0;
        }

        return Cache::remember($cacheKey, now()->addMinutes($cacheTTL), function () use ($method) {

            $client = new Client($this->httpClientOptions());

            $response = $client->request($method, $this->config['url'], [
                'headers' => $this->config['headers'],
                'verify' => false
            ]);

            $card = $this->leggiCard($response->getBody()->getContents());

            $ospedali = [];

            foreach ($this->config['data'] as $keyH => $ospedale) {
                $rilevazione = $card[$this->normalizza($ospedale['codice'])] ?? null;

                // Card assente (PS rimosso dal portale o titolo cambiato): meglio
                // non pubblicare nulla che pubblicare zeri, che verrebbero letti
                // come "nessun paziente in attesa".
                if ($rilevazione === null) {
                    continue;
                }

                $ospedali[$keyH]['data'] = $this->contatori($rilevazione);
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
     * Estrae le card della pagina indicizzandole per titolo normalizzato.
     *
     * @return array<string, array<string, array<string, int>>>
     */
    protected function leggiCard(string $html): array
    {
        $crawler = new Crawler($html);

        $card = [];

        $crawler->filter('div.ds-container.shadow-sm')->each(function (Crawler $nodo) use (&$card) {
            $titolo = $nodo->filter('h2');

            if (!$titolo->count()) {
                return;
            }

            $card[$this->normalizza($titolo->text(''))] = $this->leggiSezioni($nodo);
        });

        return $card;
    }

    /**
     * Le righe di chip non sono etichettate: si riconoscono dal <p> che le
     * precede, quindi la card va percorsa nell'ordine del documento.
     *
     * @return array<string, array<string, int>>
     */
    protected function leggiSezioni(Crawler $card): array
    {
        $sezioni = [];
        $chiave = null;

        $card->children()->each(function (Crawler $nodo) use (&$sezioni, &$chiave) {
            $tag = $nodo->nodeName();

            if ($tag === 'p') {
                $chiave = self::SEZIONI[$this->normalizza($nodo->text(''))] ?? null;

                return;
            }

            if ($tag === 'div' && $chiave !== null && str_contains($nodo->attr('class') ?? '', 'd-flex')) {
                $sezioni[$chiave] = $this->leggiChip($nodo);
                $chiave = null;
            }
        });

        return $sezioni;
    }

    /**
     * @return array<string, int>
     */
    protected function leggiChip(Crawler $riga): array
    {
        $valori = [];

        $riga->filter('div.chip')->each(function (Crawler $chip) use (&$valori) {
            $classi = $chip->attr('class') ?? '';

            foreach (self::COLORI as $classe => $colore) {
                if (str_contains($classi, $classe)) {
                    $valori[$colore] = (int) trim($chip->text(''));

                    return;
                }
            }
        });

        return $valori;
    }

    /**
     * Contatori nel formato usato dal resto dell'applicazione.
     */
    protected function contatori(array $rilevazione): array
    {
        $contatori = [];
        $totali = ['in_attesa' => 0, 'in_trattamento' => 0, 'trattati_8h' => 0];

        foreach (self::COLORI as $colore) {
            $attesa = $rilevazione['in_attesa'][$colore] ?? 0;

            $extra = [];

            foreach (self::ETICHETTE as $chiave => $label) {
                $extra[$chiave] = [
                    'label' => $label,
                    'value' => $rilevazione[$chiave][$colore] ?? 0,
                ];

                if (isset($totali[$chiave])) {
                    $totali[$chiave] += $rilevazione[$chiave][$colore] ?? 0;
                }
            }

            $contatori[$colore] = [
                'value' => $attesa,
                'extra' => $extra,
            ];
        }

        $contatori['totali'] = [
            'value' => $totali['in_attesa'],
            'extra' => array_map(static fn(string $chiave): array => [
                'label' => self::ETICHETTE[$chiave],
                'value' => $totali[$chiave],
            ], array_keys($totali)),
        ];

        return $contatori;
    }

    /**
     * I titoli sul portale arrivano con spaziature doppie, maiuscole incoerenti
     * e apostrofi tipografici: normalizzo per poterli abbinare al config.
     */
    protected function normalizza(string $testo): string
    {
        $testo = str_replace(["\u{2019}", "\u{2018}", "\u{00A0}"], ["'", "'", ' '], $testo);

        return trim(preg_replace('/\s+/u', ' ', mb_strtolower($testo)));
    }
}
