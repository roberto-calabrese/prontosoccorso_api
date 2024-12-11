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

class AslvcAJaxJob implements ShouldQueue
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
                        'in_osservazione' => [
                            'label' => 'Pazienti in osservazione',
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
                        'in_osservazione' => [
                            'label' => 'Pazienti in osservazione',
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
                        'in_osservazione' => [
                            'label' => 'Pazienti in osservazione',
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
                        'in_osservazione' => [
                            'label' => 'Pazienti in osservazione',
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
                        'in_osservazione' => [
                            'label' => 'Pazienti in osservazione',
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
                        'in_osservazione' => [
                            'label' => 'Pazienti in osservazione',
                            'value' => 0,
                        ]
                    ]
                ],
                'extra' => [
                    'sale' => []
                ]
            ];

            foreach ($this->config['data'] as $keyH => $ospedale) {
                $sale = [];

                foreach ($dati['patients'] as $patient) {
                    $priority = strtolower($patient['priorityDescription']);
                    $state = $patient['state'];
                    $isObi = $patient['obi'];

                    if ($state === "ATTESA") {
                        $counters['totali']['value']++;
                        $counters['totali']['extra']['in_attesa']['value']++;

                        if (isset($counters[$priority])) {
                            $counters[$priority]['value']++;
                            $counters[$priority]['extra']['in_attesa']['value']++;
                        }
                    } elseif ($state === "VISITA") {
                        $key = $isObi ? 'in_osservazione' : 'in_trattamento';
                        $counters['totali']['extra'][$key]['value']++;
                        if (isset($counters[$priority])) {
                            $counters[$priority]['extra'][$key]['value']++;
                        }

                        $stateConsulting = $patient['providerDescription'] ?? 'null';
                        $sale[$stateConsulting] = ($sale[$stateConsulting] ?? 0) + 1;
                    }
                }

                $extra = array_map(static fn($label, $value) => ['label' => $label, 'value' => $value], array_keys($sale), $sale);

                $ospedali[$keyH]['data'] = $counters;
                $ospedali[$keyH]['data']['extra'] = $extra;
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
