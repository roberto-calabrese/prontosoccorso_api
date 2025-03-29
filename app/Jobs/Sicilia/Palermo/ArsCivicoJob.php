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

class ArsCivicoJob implements ShouldQueue
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

            $response = $client->request('GET', $this->config['url'], ['verify' => false]);

            $crawler = new Crawler($response->getBody()->getContents());

            $ospedali = [];

            foreach ($this->config['data'] as $keyH => $ospedale) {
                foreach ($ospedale['data'] as $key => $value) {
                    if ($key !== 'extra') {
                        $this->processHospitalData($ospedali, $keyH, $value, $crawler);
                    } else {
                        // Estrai tutto il testo dal <span>
                        $fullText = $this->cleanText(implode('', $crawler->filter(reset($value)['selector'])->extract(['_text'])));

                        foreach ($value as $extraK => $extraV) {
                            $ospedali[$keyH]['data'][$key][$extraK] = $ospedale['data'][$key][$extraK];

                            // Nuove regex per il testo estratto
                            $regexPatterns = [
                                'indice_sovraffollamento' => '/Indice Sovraffollamento:\s*(\d+)%/i',
                                'numero_pazienti_con_una_permanenza24h' => '/Numero pazienti con una permanenza 24h:\s*(\d+)/i',
                                'numero_pazienti_con_una_permanenza_compresa_tra24h_e48h' => '/Numero pazienti con una permanenza compresa tra 24h e 48h:\s*(\d+)/i',
                                'numero_pazienti_con_una_permanenza48h' => '/Numero pazienti con una permanenza >48h:\s*(\d+)/i',
                                'numero_posti_tecnici_presidiati_del_ps_fissati_dalla_direzione_aziendale' => '/Numero posti tecnici presidiati del PS fissati dalla Direzione Aziendale:\s*(\d+)/i',
                                'efficienza_operativa_standard' => '/Efficienza operativa \(Standard = 0,05\):\s*([\d.]+)/i',
                            ];

                            // Applica la regex corretta
                            if (isset($regexPatterns[$extraK]) && preg_match($regexPatterns[$extraK], $fullText, $matches)) {
                                $cleanedValue = trim($matches[1]);
                                $ospedali[$keyH]['data'][$key][$extraK]['value'] = ($extraK === 'indice_sovraffollamento') ? (int) $cleanedValue : $cleanedValue;
                            } else {
                                $ospedali[$keyH]['data'][$key][$extraK]['value'] = null; // Se non trova nulla, assegna null
                            }

                            // Pulizia dei dati
                            unset($ospedali[$keyH]['data'][$key][$extraK]['selector']);
                            unset($ospedali[$keyH]['data'][$key][$extraK]['regex']); // Rimuove la regex dall'array
                        }
                    }
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
        $selectorTable = str_replace('> tbody > tr:nth-of-type(REPLACE)', '>tbody tr', $value);
        $table = $crawler->filter($selectorTable);

        $maxI = ($table->count());
        for ($i = 2; $i <= $maxI; $i++) {
            $selector = str_replace('REPLACE', $i, $value);

            $data = $this->extractDataFromSelector($crawler, $selector, $i === $maxI);
            foreach ($data as $row => $rowData) {
//                $ospedali[$keyH]['data'][$row]['value'] = $i !== $maxI ? $rowData[0] : array_sum(array_slice($rowData, 0, 3));
                $ospedali[$keyH]['data'][$row]['value'] = $rowData[0];
                foreach (['pazienti_in_attesa','pazienti_in_trattamento', 'pazienti_in_osservazione', 'pazienti_totali'] as $extraType) {
                    $ospedali[$keyH]['data'][$row]['extra'][$extraType]['label'] = ucfirst(str_replace('_', ' ', $extraType));
                    if ($row === 'totali' && $extraType  === 'pazienti_totali') {
                        $ospedali[$keyH]['data'][$row]['extra'][$extraType]['value'] = array_sum(array_slice($rowData, 0, 3));
                    } else {
                        $ospedali[$keyH]['data'][$row]['extra'][$extraType]['value'] = $rowData[array_search($extraType, ['pazienti_in_attesa','pazienti_in_trattamento', 'pazienti_in_osservazione', 'pazienti_totali'])];
                    }

                }
            }
        }

        unset($ospedali[$keyH]['data']['calculate_selector']);
    }
}
