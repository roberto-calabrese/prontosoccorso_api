<?php

namespace App\Jobs;

use App\Events\PusherEvent;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class GenericScrapeJob implements ShouldQueue
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

            $response = $client->request('GET', $this->config['url'], [
                'headers' => $this->config['headers'] ?? [],
                'verify' => false
            ]);

            $crawler = new Crawler($response->getBody()->getContents());

            $ospedali = [];

            foreach ($this->config['data'] as $keyH => $ospedale) {
                foreach ($ospedale['data'] as $key => $value) {

                    if (!isset($value['selector'])) {
                        continue;
                    }

                    if ($key !== 'extra') {
                        $ospedali[$keyH]['data'][$key]['value'] = (int)preg_replace("/[^0-9]/", "", implode('', $crawler->filter($value['selector'])->extract(['_text'])));
                        if(isset($value['extra']) && is_array($value['extra'])) {
                            foreach ($value['extra'] as $extra_k => $extra_v) {
                                $extra_v['value'] = (int)preg_replace("/[^0-9]/", "", implode('', $crawler->filter($extra_v['selector'])->extract(['_text'])));
                                unset($extra_v['selector']);
                                $ospedali[$keyH]['data'][$key]['extra'][$extra_k] = $extra_v;
                            }
                        }

                        unset($ospedali[$keyH]['data'][$key]['selector']);
                    } else {
                        foreach ($value as $extraK => $extraV) {
                            $ospedali[$keyH]['data'][$key][$extraK] = $ospedale['data'][$key][$extraK];
                            $cleanedValue = implode('', $crawler->filter($extraV['selector'])->extract(['_text']));
                            $ospedali[$keyH]['data'][$key][$extraK]['value'] = ($extraK === 'indice_sovraffollamento') ? (int)preg_replace('/[^0-9.]/', '', $cleanedValue) : $cleanedValue;
                            unset($ospedali[$keyH]['data'][$key][$extraK]['selector']);
                        }
                    }
                }

                if (isset($ospedale['data']['totali']['action']) && $ospedale['data']['totali']['action']['operation'] === 'sum') {
                    $totaliKeys = $ospedale['data']['totali']['action']['keys'];
                    $totals = $this->calcolaTotali($ospedali[$keyH]['data'], $totaliKeys);

                    // Assegna i totali calcolati
                    $ospedali[$keyH]['data']['totali'] = [
                        'value' => $totals['in_attesa'] ?? 0,
                        'extra' => array_map(static function($key, $info) use ($totals) {
                            return [
                                'label' => $info['label'],
                                'value' => $totals[$key] ?? 0, // Default a 0 se non esiste la chiave
                            ];
                        }, array_keys($totaliKeys), $totaliKeys),
                    ];
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


    private function calcolaTotali($data, $keys): array
    {
        $totals = array_fill_keys(array_keys($keys), 0);

        foreach ($data as $codice => $field) {
            if ($codice === 'totali') {
                continue;
            }

            // Somma i valori principali
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

}
