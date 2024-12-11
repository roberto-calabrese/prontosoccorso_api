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

class CittaDellaSaluteAJaxJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
                'headers' => $this->config['headers'],
                'verify' => false
            ]);

            $body = $response->getBody();

            $dati = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

            $ospedali = [];

            $counters = [
                'rosso' => [
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
                ],
                'arancione' => [
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
                ],
                'azzurro' => [
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
                ],
                'verde' => [
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
                ],
                'bianco' => [
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
                ],
                'totali' => [
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
                ],
                'extra' => [
                    'sale' => []
                ]
            ];

            foreach ($this->config['data'] as $keyH => $ospedale) {

                foreach ($dati['colors'] as $k => $codice) {

                    $colore = $codice['colore'] === 'arancio' ? 'arancione' : $codice['colore'] ;
                    $attesa = (int) $codice['attesa'];
                    $visita = (int) $codice['visita'];

                    if ($colore) {
                        $counters[$colore]['value'] = $attesa;
                        $counters[$colore]['extra']['in_attesa']['value'] = $attesa;
                        $counters[$colore]['extra']['in_trattamento']['value'] = $visita;

                        $counters['totali']['value'] += $attesa;
                        $counters['totali']['extra']['in_attesa']['value'] += $attesa;
                        $counters['totali']['extra']['in_trattamento']['value'] += $visita;
                    }


                    $ospedali[$keyH]['data'] = $counters;
                }
            }

            if ($this->websocket) {
                event(new PusherEvent($ospedali, [
                    'channel' => $this->websocket['channel'],
                    'event' => $this->websocket['event']
                ]));
            }

            return $ospedali;

        });
    }

    private function calcolaTotaliPerChiave($dati, $fields): float|int|string
    {
        $sum = 0;
        foreach ($fields as $field) {
            $value = data_get($dati, $field);
            $sum += is_numeric($value) ? $value : 0;
        }
        return $sum;
    }
}
