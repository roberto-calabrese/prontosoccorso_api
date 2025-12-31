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

            $options = [
                'headers' => $this->config['headers'],
                'verify' => false
            ];

            if (isset($this->config['body'])) {
                $options['json'] = $this->config['body'];
            }

            $response = $client->request($method, $this->config['url'], $options);

            $body = $response->getBody();

            $dati = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

            if (isset($this->config['transformations'])) {
                $dati = $this->applyTransformations($dati, $this->config['transformations']);
            }

            $ospedali = [];

            foreach ($this->config['data'] as $keyH => $ospedale) {

                foreach ($ospedale['data'] as $key => $value) {

                    if(isset($value['action'])) {
                        continue;
                    }

                    if ($key !== 'extra' ) {
                        $default = $value['default'] ?? null;
                        $extractedValue = data_get($dati, $value['selector'], $default);

                        if (isset($value['format'])) {
                            $extractedValue = $this->applyFormat($extractedValue, $value['format']);
                        }

                        $ospedali[$keyH]['data'][$key]['value'] = $extractedValue;

                        if(isset($value['extra']) && is_array($value['extra'])) {
                            foreach ($value['extra'] as $extra_k => $extra_v) {
                                $extraDefault = $extra_v['default'] ?? null;
                                $extraVal = data_get($dati, $extra_v['selector'], $extraDefault);

                                if (isset($extra_v['format'])) {
                                    $extraVal = $this->applyFormat($extraVal, $extra_v['format']);
                                }

                                $extra_v['value'] = $extraVal;
                                unset($extra_v['selector'], $extra_v['default'], $extra_v['format']);
                                $ospedali[$keyH]['data'][$key]['extra'][$extra_k] = $extra_v;
                            }
                        }

                        unset($ospedali[$keyH]['data'][$key]['selector'], $ospedali[$keyH]['data'][$key]['default'], $ospedali[$keyH]['data'][$key]['format']);
                    } else {
                        foreach ($value as $extraK => $extraV) {
                            $ospedali[$keyH]['data'][$key][$extraK] = $ospedale['data'][$key][$extraK];
                            $default = $extraV['default'] ?? null;
                            $cleanedValue = data_get($dati, $extraV['selector'], $default);
                            $ospedali[$keyH]['data'][$key][$extraK]['value'] = ($extraK === 'indice_sovraffollamento') ? (int)preg_replace('/[^0-9.]/', '', $cleanedValue) : $cleanedValue;
                            unset($ospedali[$keyH]['data'][$key][$extraK]['selector'], $ospedali[$keyH]['data'][$key][$extraK]['default']);

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

    private function applyTransformations($dati, $transformations)
    {
        if (isset($transformations['key_by'])) {
            $dati = collect($dati)->keyBy($transformations['key_by'])->toArray();
        }

        if (isset($transformations['path_key_by'])) {
            foreach ($transformations['path_key_by'] as $path => $keyField) {
                $this->transformPath($dati, explode('.', $path), $keyField);
            }
        }

        return $dati;
    }

    private function applyFormat($value, $format)
    {
        switch ($format) {
            case 'minutes_to_time':
                if (!is_numeric($value)) {
                    return $value;
                }
                $minutes = (int) $value;
                if ($minutes < 60) {
                    return $minutes . 'm';
                }
                $hours = floor($minutes / 60);
                $mins = $minutes % 60;
                return sprintf('%dh %02dm', $hours, $mins);

            default:
                return $value;
        }
    }

    private function transformPath(&$data, $pathSegments, $keyField)
    {
        $segment = array_shift($pathSegments);

        if ($segment === '*') {
            if (is_array($data)) {
                foreach ($data as &$item) {
                    $this->transformPath($item, $pathSegments, $keyField);
                }
            }
            return;
        }

        if (empty($pathSegments)) {
            if (isset($data[$segment]) && is_array($data[$segment])) {
                $data[$segment] = collect($data[$segment])->keyBy($keyField)->toArray();
            }
            return;
        }

        if (isset($data[$segment])) {
            $this->transformPath($data[$segment], $pathSegments, $keyField);
        }
    }
}
