<?php

namespace App\Jobs\Sicilia\Palermo;

use App\Events\PusherEvent;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class PoliclinicoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected bool $websocket;

    /**
     * Create a new job instance.
     */
    public function __construct(bool $websocket = false)
    {
        $this->websocket = $websocket;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

//        sleep(10);

        $config = config('regioni.sicilia.palermo.ospedali.policlinico');

        return Cache::remember($config['cache']['key'], now()->addMinutes($config['cache']['ttlMinute']), function () use ($config) {
            $client = new Client();

            $response = $client->request('GET', $config['url']);

            $crawler = new Crawler($response->getBody()->getContents());

            $ospedali = [];

            foreach ($config['data'] as $keyH => $ospedale) {
                foreach ($ospedale['data'] as $key => $value) {
                    if ($key !== 'extra') {
                        $ospedali[$keyH]['data'][$key]['value'] = implode('', $crawler->filter($value['selector'])->extract(['_text']));

                        if(isset($value['extra']) && is_array($value['extra'])) {
                            foreach ($value['extra'] as $extra_k => $extra_v) {
                                $extra_v['value'] = implode('', $crawler->filter($extra_v['selector'])->extract(['_text']));
                                unset($extra_v['selector']);
                                $ospedali[$keyH]['data'][$key]['extra'][$extra_k] = $extra_v;
                            }
                        }

                        unset($ospedali[$keyH]['data'][$key]['selector']);
                    } else {
                        foreach ($value as $extraK => $extraV) {
                            $ospedali[$keyH]['data'][$key][$extraK] = $ospedale['data'][$key][$extraK];
                            $cleanedValue = implode('', $crawler->filter($extraV['selector'])->extract(['_text']));
                            $ospedali[$keyH]['data'][$key][$extraK]['value'] = ($extraK === 'indice_sovraffollamento') ? (int)preg_replace('/[^0-9]/', '', $cleanedValue) : $cleanedValue;
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