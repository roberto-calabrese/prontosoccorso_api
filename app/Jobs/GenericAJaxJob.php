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

class GenericAJaxJob implements ShouldQueue
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
            return;
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

            foreach ($this->config['data'] as $keyH => $ospedale) {

                foreach ($ospedale['data'] as $key => $value) {

                    if(isset($value['action'])) {
                        continue;
                    }

                    if ($key !== 'extra' ) {
                        $ospedali[$keyH]['data'][$key]['value'] = data_get($dati, $value['selector']);

                        if(isset($value['extra']) && is_array($value['extra'])) {
                            foreach ($value['extra'] as $extra_k => $extra_v) {
                                $extra_v['value'] = data_get($dati, $extra_v['selector']);
                                unset($extra_v['selector']);
                                $ospedali[$keyH]['data'][$key]['extra'][$extra_k] = $extra_v;
                            }
                        }

                        unset($ospedali[$keyH]['data'][$key]['selector']);
                    } else {
                        foreach ($value as $extraK => $extraV) {
                            $ospedali[$keyH]['data'][$key][$extraK] = $ospedale['data'][$key][$extraK];
                            $cleanedValue = data_get($dati, $extraV['selector']);
                            $ospedali[$keyH]['data'][$key][$extraK]['value'] = ($extraK === 'indice_sovraffollamento') ? (int)preg_replace('/[^0-9.]/', '', $cleanedValue) : $cleanedValue;
                            unset($ospedali[$keyH]['data'][$key][$extraK]['selector']);

                        }
                    }
                }

                if (isset($ospedale['data']['totali']['action']) && $ospedale['data']['totali']['action']['operation'] === 'sum') {
                    $totali = $ospedale['data']['totali']['action']['keys'];

                    $totals = [];

                    foreach ($totali as $key => $total) {
                        $totals[$key] = $this->calcolaTotaliPerChiave($dati, $total['fields']);
                    }

                    $ospedali[$keyH]['data']['totali'] = [
                        'value' => $totals['in_attesa'] ?? 0,
                        'extra' => array_map(static function($key, $info) use ($totals) {
                            return [
                                'label' => $info['label'],
                                'value' => $totals[$key] ?? 0,
                            ];
                        }, array_keys($totali), $totali),
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
