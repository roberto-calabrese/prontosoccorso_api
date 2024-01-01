<?php

namespace App\Jobs\Palermo;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\DomCrawler\Crawler;

class OspedaliRiunitiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     * @throws GuzzleException
     */
    public function handle(): array
    {
        $client = new Client();


        $response = $client->request('GET', config('palermo.ospedaliRiuniti.url'));


        // Utilizza Symfony DomCrawler per analizzare il documento HTML
        $crawler = new Crawler($response->getBody()->getContents());

        $ospedali = config('palermo.ospedaliRiuniti.data');

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

        //TODO EVENT WEBSOCKET CHANNEL PALERMO

        return $ospedali;
    }
}
