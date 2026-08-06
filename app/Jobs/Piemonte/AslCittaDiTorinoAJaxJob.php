<?php

namespace App\Jobs\Piemonte;

use App\Events\PusherEvent;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use App\Jobs\Concerns\AlertsOnScrapeFailure;

class AslCittaDiTorinoAJaxJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AlertsOnScrapeFailure;

    /**
     * Mappatura dei codici priorita' dell'ASL Citta' di Torino sui colori interni.
     */
    protected const COLORI = [
        '1' => 'rosso',
        '2' => 'arancione',
        '3' => 'azzurro',
        '4' => 'verde',
        '5' => 'bianco',
    ];

    protected array $websocket;

    protected array $config;

    /**
     * Create a new job instance.
     */
    public function __construct(array $websocket, array $config)
    {
        $this->websocket = $websocket;
        $this->config = $config;
    }

    /**
     * Execute the job.
     */
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

            $client = new Client();

            $response = $client->request($method, $this->config['url'], [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken($client),
                ] + $this->config['headers'],
                'verify' => false
            ]);

            $body = $response->getBody();

            $dati = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

            // La risposta contiene tutte le strutture: le indicizzo per codice
            // cosi' da abbinarle agli ospedali dichiarati in configurazione.
            $strutture = collect($dati)->keyBy('codice');

            $ospedali = [];

            foreach ($this->config['data'] as $keyH => $ospedale) {
                $struttura = $strutture->get($ospedale['codice']);

                $counters = $this->emptyCounters();

                foreach ($struttura['rilevazione']['rilevazioni'] ?? [] as $rilevazione) {
                    $colore = self::COLORI[$rilevazione['codicePriorita']['codice']] ?? null;

                    if (!$colore) {
                        continue;
                    }

                    $attesa = (int) $rilevazione['pazientiInLista'];
                    $visita = (int) $rilevazione['pazientiInVisita'];

                    $counters[$colore]['value'] = $attesa;
                    $counters[$colore]['extra']['in_attesa']['value'] = $attesa;
                    $counters[$colore]['extra']['in_trattamento']['value'] = $visita;
                    $counters[$colore]['extra']['tempo_medio_attesa']['value'] = (int) $rilevazione['tempoMedioAttesa'];

                    $counters['totali']['value'] += $attesa;
                    $counters['totali']['extra']['in_attesa']['value'] += $attesa;
                    $counters['totali']['extra']['in_trattamento']['value'] += $visita;
                }

                $ospedali[$keyH]['data'] = $counters;
                $ospedali[$keyH]['data']['extra'] = $this->extra($struttura);
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
     * Recupera il token OAuth (password grant) tenendolo in cache
     * per la durata dichiarata dal servizio.
     */
    protected function getAccessToken(Client $client): string
    {
        $auth = $this->config['auth'];

        return Cache::remember($this->config['cache']['key'] . '.token', now()->addMinutes(5), function () use ($client, $auth) {

            $response = $client->request('POST', $auth['url'], [
                'headers' => $this->config['headers'] + [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'auth' => [$auth['clientId'], $auth['clientSecret']],
                'form_params' => [
                    'username' => $auth['username'],
                    'password' => $auth['password'],
                    'grant_type' => 'password',
                ],
                'verify' => false
            ]);

            $token = json_decode($response->getBody(), true, 512, JSON_THROW_ON_ERROR);

            return $token['access_token'];
        });
    }

    /**
     * Informazioni aggiuntive presenti nella risposta ma non legate a un codice colore.
     */
    protected function extra(?array $struttura): array
    {
        $extra = [
            [
                'label' => 'Ambulanze in arrivo',
                'value' => (int) ($struttura['rilevazione']['ambulanzeInArrivo'] ?? 0),
            ],
            [
                'label' => 'Ultimo aggiornamento',
                'value' => isset($struttura['rilevazione']['dataOra'])
                    ? \Carbon\Carbon::parse($struttura['rilevazione']['dataOra'])->timezone('Europe/Rome')->format('d/m/Y H:i')
                    : null,
            ],
        ];

        if (!empty($struttura['avvisi'])) {
            $extra[] = [
                'label' => 'Avvisi',
                'value' => $struttura['avvisi'],
            ];
        }

        return $extra;
    }

    /**
     * Struttura contatori azzerata per ogni codice colore piu' i totali.
     */
    protected function emptyCounters(): array
    {
        $counters = [];

        foreach ([...array_values(self::COLORI), 'totali'] as $colore) {
            $counters[$colore] = [
                'value' => 0,
                'extra' => [
                    'in_attesa' => [
                        'label' => 'Pazienti in attesa',
                        'value' => 0,
                    ],
                    'in_trattamento' => [
                        'label' => 'Pazienti in trattamento',
                        'value' => 0,
                    ],
                ]
            ];

            if ($colore !== 'totali') {
                $counters[$colore]['extra']['tempo_medio_attesa'] = [
                    'label' => 'Tempo medio di attesa (minuti)',
                    'value' => 0,
                ];
            }
        }

        return $counters;
    }
}
