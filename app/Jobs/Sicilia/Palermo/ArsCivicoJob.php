<?php

namespace App\Jobs\Sicilia\Palermo;

use App\Events\PusherEvent;
use Event;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\DomCrawler\Crawler;

class ArsCivicoJob implements ShouldQueue
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

        $config = config('regioni.sicilia.palermo.ospedali.arsCivico');

        return Cache::remember($config['cache']['key'], now()->addMinutes($config['cache']['ttlMinute']), function () use ($config) {
            $client = new Client();

            $response = $client->request('GET', $config['url']);

            $crawler = new Crawler($response->getBody()->getContents());

            $ospedali = [];

            foreach ($config['data'] as $keyH => $ospedale) {
                foreach ($ospedale['data'] as $key => $value) {
                    if ($key !== 'extra') {
                        $this->processHospitalData($ospedali, $keyH, $value, $crawler);
                    } else {
                        foreach ($value as $extraK => $extraV) {
                            $ospedali[$keyH]['data'][$key][$extraK] = $ospedale['data'][$key][$extraK];
                            $ospedali[$keyH]['data'][$key][$extraK]['value'] = $this->cleanText(implode('', $crawler->filter($extraV['selector'])->extract(['_text'])));
                            unset($ospedali[$keyH]['data'][$key][$extraK]['selector']);
                        }
                    }
                }
            }

            if ($this->websocket) {
                event(new PusherEvent($ospedali, [
                    'channel' => config('regioni.sicilia.palermo.websocket.channel'),
                    'event' => config('regioni.sicilia.palermo.websocket.event'),
                ]));
            }

            return $ospedali;
        });

    }

    protected function cleanText($text): array|string
    {
        return str_replace("\u{A0}", '', $text);
    }

    protected function extractDataFromSelector($crawler, $selector, $isHeader = false): array
    {
        $data = [];
        $maxJ = 5;
        for ($j = 1; $j <= $maxJ; $j++) {
            $selectorRow = $selector . ">" . ($isHeader ? "th" : "td") . ":nth-child($j)";
            $result = $this->cleanText(implode('', $crawler->filter($selectorRow)->extract(['_text'])));

            if ($j === 1) {
                $row = str_replace("totale", 'totali', strtolower($result));
            } else {
                $data[$row][] = $result;
            }
        }

        return $data;
    }

    protected function processHospitalData(&$ospedali, $keyH, $value, $crawler): void
    {
        $selectorTable = str_replace('>tbody>tr:nth-child(REPLACE)', '>tbody tr', $value);
        $table = $crawler->filter($selectorTable);
        $maxI = ($table->count());

        for ($i = 2; $i <= $maxI; $i++) {
            $selector = str_replace('REPLACE', $i, $value);

            $data = $this->extractDataFromSelector($crawler, $selector, $i === $maxI);

            foreach ($data as $row => $rowData) {
                $ospedali[$keyH]['data'][$row]['value'] = $i !== $maxI ? $rowData[3] : array_sum(array_slice($rowData, 0, 3));

                foreach (['pazienti_in_attesa', 'pazienti_in_trattamento', 'pazienti_in_osservazione'] as $extraType) {
                    $ospedali[$keyH]['data'][$row]['extra'][$extraType]['label'] = ucfirst(str_replace('_', ' ', $extraType));
                    $ospedali[$keyH]['data'][$row]['extra'][$extraType]['value'] = $rowData[array_search($extraType, ['pazienti_in_attesa', 'pazienti_in_trattamento', 'pazienti_in_osservazione'])];
                }
            }
        }
        unset($ospedali[$keyH]['data']['calculate_selector']);
    }
}
