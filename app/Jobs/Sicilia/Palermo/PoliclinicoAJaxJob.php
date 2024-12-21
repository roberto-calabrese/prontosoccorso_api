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

class PoliclinicoAJaxJob implements ShouldQueue
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

            $response_indici = $client->request($method, $this->config['url_indici'], [
                'headers' => $this->config['headers'],
                'verify' => false
            ]);

            $body = $response->getBody();
            $body_indici = $response_indici->getBody();


            $dati = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            $dati_indici = json_decode($body_indici, true, 512, JSON_THROW_ON_ERROR);

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
                    }
                }

                /*
                 * 'extra' => [
                            'in_attesa' => [
                                'label' => 'Pazienti in attesa',
                                'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                            ],
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(5)',
                            ],
                            'aggiornamento' => [
                                'label' => 'Aggiornato al',
                                'selector' => 'div.olo-row-dati-aggiornati-al',
                            ],
                        ],
                 */

                if ($dati_indici) {
                    $ospedali[$keyH]['data']['extra'] = [
                        'efficienzaOperativaStandard'  => [
                            'label' => 'Efficienza Operativa Standard',
                            'value' => data_get($dati_indici, 'efficienzaOperativaStandard')
                        ],
                        'permanenza24H'  => [
                            'label' => 'Permanenza 24h',
                            'value' => data_get($dati_indici, 'permanenza24H')
                        ],
                        'permanenza2448H'  => [
                            'label' => 'Permanenza 24h48H',
                            'value' => data_get($dati_indici, 'permanenza2448H')
                        ],
                        'permanenzaOltre24H'  => [
                            'label' => 'Permanenza Oltre 24h',
                            'value' => data_get($dati_indici, 'permanenzaOltre24H')
                        ],
                        'postiTecniciPresidiati'  => [
                            'label' => 'Posti Tecnici Presidiati',
                            'value' => data_get($dati_indici, 'postiTecniciPresidiati')
                        ],
                        'indice_sovraffollamento'  => [
                            'label' => 'Indice Sovraffollamento',
                            'value' => $this->calcolaIndiceSovraffollamento($dati_indici)
                        ],
                    ];
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


    private function filterNumber($value) {
        return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    private function calcolaIndiceSovraffollamento($dati): float
    {
        $permanenza24H = (int)$this->filterNumber($dati['permanenza24H']);
        $permanenza2448H = (int)$this->filterNumber($dati['permanenza2448H']);
        $permanenzaOltre24H = (int)$this->filterNumber($dati['permanenzaOltre24H']);
        $postiTecniciPresidiati = (int)$this->filterNumber($dati['postiTecniciPresidiati']);

        $pazientiTotali = $permanenza24H + $permanenza2448H + $permanenzaOltre24H;

        $indiceSovraffollamento = ($pazientiTotali / $postiTecniciPresidiati) * 100;

        return round($indiceSovraffollamento, 2);
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
