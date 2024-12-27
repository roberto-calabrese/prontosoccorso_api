<?php

namespace App\Jobs\Toscana;

use App\Events\PusherEvent;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class UslCentroScrapeJob implements ShouldQueue
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

        $lockKey = "lock:{$cacheKey}";

        if (!Cache::add($lockKey, true, $cacheTTL)) {
            return;
        }

        return Cache::remember($cacheKey, now()->addMinutes($cacheTTL), function () {
            $client = new Client();

            $response = $client->request($this->config['method'] ?? 'GET', $this->config['url'], [
                'headers' => $this->config['headers'] ?? [],
                'verify' => false,
                'query' => $this->config['query'] ?? null,
                'form_params' => $this->config['form_params'] ?? null
            ]);

            $crawler = new Crawler($response->getBody()->getContents());

            $ospedali = [];


            foreach ($this->config['data'] as $keyH => $ospedale) {

                $name = $ospedale['data']['name'];

                $hospitalContainer = $crawler->filter("h4:contains('$name')")->closest(".container");

                $tableContainer = $hospitalContainer->nextAll()->filter('.container')->first();
                $table = $tableContainer->filter('table');

                $dataCommon = [
                    'rosso' => [],
                    'giallo' => [],
                    'verde' => [],
                    'azzurro' => [],
                    'bianco' => [],
                    'totali' => [],
                ];

                $colors = ['rosso', 'giallo', 'verde', 'azzurro', 'bianco'];

                $codici = $table->filter('tbody')->filter('div h4')->each(fn($node) => (int)$node->text());

                $inTrattamento = array_slice($codici, 0, 5);
                $inAttesa = array_slice($codici, 5, 5);

                foreach ($colors as $index => $color) {
                    $dataCommon[$color] = [
                        'value' => $inAttesa[$index] ?? null,
                        'extra' => [
                            'in_attesa' => [
                                'label' => 'Pazienti in attesa',
                                'value' => $inAttesa[$index] ?? null,
                            ],
                            'in_trattamento' => [
                                'label' => 'Pazienti in trattamento',
                                'value' => $inTrattamento[$index] ?? null,
                            ]
                        ]
                    ];
                }

                $dataCommon['totali'] = [
                    'value' => array_sum($inAttesa),
                    'extra' => [
                        'in_attesa' => [
                            'label' => 'Pazienti in attesa',
                            'value' => array_sum($inAttesa),
                        ],
                        'in_trattamento' => [
                            'label' => 'Pazienti in trattamento',
                            'value' => array_sum($inTrattamento),
                        ]
                    ]
                ];

                $ospedali[$keyH]['data'] = $dataCommon;


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


    private function calcolaTotali($data, $keys): array
    {
        $totals = array_fill_keys(array_keys($keys), 0);

        foreach ($data as $codice => $field) {
            if ($codice === 'totali') {
                continue;
            }

            foreach ($keys as $key => $info) {
                if (($key === 'in_attesa') && isset($field['value']) && is_numeric($field['value'])) {
                    $totals[$key] += $field['value'];
                }
                if (($key !== 'in_attesa') && isset($field['extra'][$key]['value']) && is_numeric($field['extra'][$key]['value'])) {
                    $totals[$key] += $field['extra'][$key]['value'];
                }
            }
        }

        return $totals;
    }

    private function replaceSelector($selector, $ospedale): string|null
    {
        if (isset($ospedale['replaceSearch'], $ospedale['replaceTo']) && preg_match($ospedale['replaceSearch'], $selector)) {
            $index = 0;
            return preg_replace_callback($ospedale['replaceSearch'], static function () use (&$index, $ospedale) {
                return $ospedale['replaceTo'][$index++];
            }, $selector);
        }

        return $selector;
    }

}
