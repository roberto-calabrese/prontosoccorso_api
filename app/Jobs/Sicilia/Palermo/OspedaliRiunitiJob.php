<?php

namespace App\Jobs\Sicilia\Palermo;

use App\Events\PusherEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class OspedaliRiunitiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected bool $websocket;

    /**
     * Create a new job instance.
     */
    public function     __construct(bool $websocket = false)
    {
        $this->websocket = $websocket;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        $config = config('regioni.sicilia.palermo.data.ospedaliRiuniti');

        return Cache::remember($config['cache']['key'], now()->addMinutes($config['cache']['ttlMinute']), function () use ($config) {
            $client = new Client();

            $response = $client->request('GET', $config['url']);

            $crawler = new Crawler($response->getBody()->getContents());

            $ospedali = $config['data'];

            foreach ($ospedali as $keyH => $ospedale) {
                foreach ($ospedale['data'] as $key => $value) {
                    if ($key !== 'extra') {
                        $ospedali[$keyH]['data'][$key]['value'] = implode('', $crawler->filter($value['selector'])->extract(['_text']));
                        unset($ospedali[$keyH]['data'][$key]['selector']);
                    } else {
                        foreach ($value as $extraK => $extraV) {
                            $ospedali[$keyH]['data'][$key][$extraK]['value'] = implode('', $crawler->filter($extraV['selector'])->extract(['_text']));
                            unset($ospedali[$keyH]['data'][$key][$extraK]['selector']);
                        }
                    }
                }
            }

            if ($this->websocket) {
                event(new PusherEvent($ospedali, ['channel' => config('regioni.sicilia.palermo.websocket.channel')]));
            }

            return $ospedali;

        });
    }
}
