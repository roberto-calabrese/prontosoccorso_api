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

    protected bool $websocket;

    protected array $config;

    /**
     * Create a new job instance.
     */
    public function __construct(bool $websocket, array $config)
    {
        $this->websocket = $websocket;
        $this->config = $config;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        return Cache::remember($this->config['cache']['key'], now()->addMinutes($this->config['cache']['ttlMinute']), function () {

            $client = new Client();

            $response = $client->request('POST', $this->config['url'], [
                'headers' => $this->config['headers']
            ]);

            $body = $response->getBody();

            $dati = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

            $ospedali = [];

            foreach ($this->config['data'] as $keyH => $ospedale) {

                foreach ($ospedale['data'] as $key => $value) {

                    if ($key !== 'extra') {
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
            }

            if ($this->websocket) {
                event(new PusherEvent($ospedali, [
                    'channel' => config('regioni.sicilia.palermo.websocket.channel'),
                    'event' => config('regioni.sicilia.palermo.websocket.event')
                ]));
            }

            return $ospedali;

        });
    }
}
