<?php

namespace App\Jobs\Lazio;

use App\Events\PusherEvent;
use App\Jobs\Concerns\AlertsOnScrapeFailure;
use App\Jobs\Concerns\HasHttpTimeouts;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Regione Lazio: i dati sono pubblicati solo dentro un report Power BI
 * incorporato, senza pagina HTML ne' API aperta. Si interroga direttamente
 * l'endpoint pubblico di Power BI usando la resource key del report (la stessa
 * che sta nel link "view?r=..."), replicando la query del visual a tabella.
 *
 * La risposta arriva nel formato compresso DSR: dizionari di valori piu' due
 * bitmask per riga, R per i valori ripetuti dalla riga precedente e Ø per i
 * null. Senza espanderle le colonne risultano disallineate.
 */
class SaluteLazioPowerBiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AlertsOnScrapeFailure, HasHttpTimeouts;

    /**
     * Colore interno -> prefisso delle colonne nel dataset.
     */
    protected const COLORI = [
        'rosso' => 'ROSSO',
        'arancione' => 'ARANCIONE',
        'azzurro' => 'AZZURRO',
        'verde' => 'VERDE',
        'bianco' => 'BIANCO',
    ];

    /**
     * Colonne richieste al dataset: dimensioni e misure da sommare.
     */
    protected const DIMENSIONI = ['ISTITUTO', 'COMUNE', 'ASL', 'TIPO', 'DATA'];

    protected const MISURE = [
        'ROSSO_ATT', 'ARANCIONE_ATT', 'AZZURRO_ATT', 'VERDE_ATT', 'BIANCO_ATT', 'NONESEG_ATT', 'TOT_ATT',
        'ROSSO_TRATT', 'ARANCIONE_TRATT', 'AZZURRO_TRATT', 'VERDE_TRATT', 'BIANCO_TRATT', 'NONESEG_TRATT', 'TOT_TRATT',
        'TOT_RT', 'TOT_OB', 'TUTTI',
    ];

    protected array $websocket;

    protected array $config;

    public function __construct(array $websocket, array $config)
    {
        $this->websocket = $websocket;
        $this->config = $config;
    }

    public function handle()
    {
        $cacheKey = $this->config['cache']['key'];
        $cacheTTL = $this->config['cache']['ttlMinute'];

        $lockKey = "lock:{$cacheKey}";

        if (!Cache::add($lockKey, true, $cacheTTL)) {
            return 0;
        }

        return Cache::remember($cacheKey, now()->addMinutes($cacheTTL), function () {

            $righe = $this->interroga();

            $ospedali = [];

            foreach ($this->config['data'] as $keyH => $ospedale) {
                $riga = $righe[$this->normalizza($ospedale['codice'])] ?? null;

                // Struttura assente dal dataset: meglio non pubblicare nulla che
                // pubblicare zeri, che verrebbero letti come "nessuno in attesa".
                if ($riga === null) {
                    continue;
                }

                $ospedali[$keyH]['data'] = $this->contatori($riga);
            }

            $this->trackScrapeOutcome($ospedali);

            if ($this->websocket) {
                event(new PusherEvent($ospedali, [
                    'channel' => $this->websocket['channel'],
                    'event' => $this->websocket['event']
                ]));
            }

            return $ospedali;

        });
    }

    /**
     * Esegue la query sul dataset e restituisce le righe indicizzate
     * per "istituto|comune" normalizzato.
     */
    protected function interroga(): array
    {
        $pbi = $this->config['powerbi'];

        $client = new Client($this->httpClientOptions());

        $response = $client->request('POST', $this->config['url'], [
            'headers' => [
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-PowerBI-ResourceKey' => $pbi['resourceKey'],
                'ActivityId' => (string) Str::uuid(),
                'RequestId' => (string) Str::uuid(),
            ] + $this->config['headers'],
            'body' => json_encode($this->corpoQuery(), JSON_THROW_ON_ERROR),
            'verify' => false,
        ]);

        $dati = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        $righe = [];

        foreach ($this->espandiDsr($dati) as $riga) {
            $chiave = $this->normalizza(($riga['ISTITUTO'] ?? '') . '|' . ($riga['COMUNE'] ?? ''));
            $righe[$chiave] = $riga;
        }

        return $righe;
    }

    /**
     * Corpo della query: replica il visual a tabella del report.
     */
    protected function corpoQuery(): array
    {
        $pbi = $this->config['powerbi'];
        $entita = $pbi['entity'];
        $sorgente = ['SourceRef' => ['Source' => 'p']];

        $select = [];

        foreach (self::DIMENSIONI as $colonna) {
            $select[] = [
                'Column' => ['Expression' => ['SourceRef' => ['Source' => 'p']], 'Property' => $colonna],
                'Name' => "$entita.$colonna",
            ];
        }

        foreach (self::MISURE as $colonna) {
            $select[] = [
                'Aggregation' => [
                    'Expression' => ['Column' => ['Expression' => $sorgente, 'Property' => $colonna]],
                    'Function' => 0, // Sum
                ],
                'Name' => "Sum($entita.$colonna)",
            ];
        }

        return [
            'version' => '1.0.0',
            'queries' => [[
                'Query' => ['Commands' => [[
                    'SemanticQueryDataShapeCommand' => [
                        'Query' => [
                            'Version' => 2,
                            'From' => [['Name' => 'p', 'Entity' => $entita, 'Type' => 0]],
                            'Select' => $select,
                        ],
                        'Binding' => [
                            'Primary' => ['Groupings' => [['Projections' => range(0, count($select) - 1)]]],
                            'DataReduction' => ['DataVolume' => 3, 'Primary' => ['Window' => ['Count' => 500]]],
                            'Version' => 1,
                        ],
                    ],
                ]]],
                'QueryId' => '',
                'ApplicationContext' => [
                    'DatasetId' => $pbi['datasetId'],
                    'Sources' => [['ReportId' => $pbi['reportId'], 'VisualId' => $pbi['visualId']]],
                ],
            ]],
            'cancelQueries' => [],
            'modelId' => $pbi['modelId'],
        ];
    }

    /**
     * Espande il DSR in righe associative.
     *
     * Nel DSR l'ordine delle colonne e' quello del descrittore S della prima
     * riga (codici G0.., M0..), non quello del descriptor della risposta: i due
     * vanno riabbinati tramite il campo Value, altrimenti i valori finiscono
     * sulle colonne sbagliate.
     *
     * @return list<array<string, mixed>>
     */
    protected function espandiDsr(array $dati): array
    {
        $risultato = $dati['results'][0]['result']['data'] ?? [];
        $ds = $risultato['dsr']['DS'][0] ?? null;

        if (!$ds) {
            return [];
        }

        $dizionari = $ds['ValueDicts'] ?? [];
        $righeDsr = $ds['PH'][0]['DM0'] ?? [];

        if (!$righeDsr) {
            return [];
        }

        $perCodice = [];
        foreach ($risultato['descriptor']['Select'] ?? [] as $colonna) {
            $perCodice[$colonna['Value']] = $colonna['Name'];
        }

        $schema = $righeDsr[0]['S'] ?? [];
        $nomi = [];
        foreach ($schema as $colonna) {
            // "Sum(prontoSoccorsoAffollamento.TOT_ATT)" -> "TOT_ATT",
            // "prontoSoccorsoAffollamento.DATA" -> "DATA"
            $nome = rtrim($perCodice[$colonna['N']] ?? $colonna['N'], ')');
            $punto = strrpos($nome, '.');

            $nomi[] = $punto === false ? $nome : substr($nome, $punto + 1);
        }

        $righe = [];
        $precedente = [];

        foreach ($righeDsr as $rigaDsr) {
            $valori = $rigaDsr['C'] ?? [];
            $ripetuti = $rigaDsr['R'] ?? 0;
            $nulli = $rigaDsr['Ø'] ?? 0;

            $riga = [];
            $i = 0;

            foreach ($schema as $idx => $colonna) {
                $bit = 1 << $idx;

                if ($nulli & $bit) {
                    $riga[$idx] = null;
                    continue;
                }

                if ($ripetuti & $bit) {
                    $riga[$idx] = $precedente[$idx] ?? null;
                    continue;
                }

                $valore = $valori[$i++] ?? null;

                if (isset($colonna['DN']) && is_int($valore)) {
                    $valore = $dizionari[$colonna['DN']][$valore] ?? $valore;
                }

                $riga[$idx] = $valore;
            }

            $precedente = $riga;
            $righe[] = array_combine($nomi, $riga);
        }

        return $righe;
    }

    /**
     * Contatori nel formato usato dal resto dell'applicazione.
     */
    protected function contatori(array $riga): array
    {
        $contatori = [];

        foreach (self::COLORI as $colore => $prefisso) {
            $contatori[$colore] = [
                'value' => (int) ($riga["{$prefisso}_ATT"] ?? 0),
                'extra' => [
                    'in_attesa' => [
                        'label' => 'Pazienti in attesa',
                        'value' => (int) ($riga["{$prefisso}_ATT"] ?? 0),
                    ],
                    'in_trattamento' => [
                        'label' => 'Pazienti in trattamento',
                        'value' => (int) ($riga["{$prefisso}_TRATT"] ?? 0),
                    ],
                ],
            ];
        }

        $contatori['totali'] = [
            'value' => (int) ($riga['TOT_ATT'] ?? 0),
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'value' => (int) ($riga['TOT_ATT'] ?? 0),
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'value' => (int) ($riga['TOT_TRATT'] ?? 0),
                ],
            ],
        ];

        // Etichette prese dalle intestazioni del report.
        $contatori['extra'] = [
            // Il triage non eseguito e' conteggiato a parte rispetto ai codici
            // colore ma rientra nei totali: senza, la somma non torna.
            'triage_non_eseguito' => [
                'label' => 'Triage non eseguito (in attesa)',
                'value' => (int) ($riga['NONESEG_ATT'] ?? 0),
            ],
            'triage_non_eseguito_trattamento' => [
                'label' => 'Triage non eseguito (in trattamento)',
                'value' => (int) ($riga['NONESEG_TRATT'] ?? 0),
            ],
            'osservazione' => [
                'label' => 'Pazienti in osservazione',
                'value' => (int) ($riga['TOT_OB'] ?? 0),
            ],
            'ricovero_trasferimento' => [
                'label' => 'In attesa di ricovero o trasferimento',
                'value' => (int) ($riga['TOT_RT'] ?? 0),
            ],
            'presenti_totali' => [
                'label' => 'Totale pazienti presenti',
                'value' => (int) ($riga['TUTTI'] ?? 0),
            ],
            'ultimo_aggiornamento' => [
                'label' => 'Ultimo aggiornamento',
                'value' => $riga['DATA'] ?? null,
            ],
        ];

        return $contatori;
    }

    protected function normalizza(string $testo): string
    {
        $testo = str_replace(["\u{2019}", "\u{2018}", "\u{00A0}"], ["'", "'", ' '], $testo);

        return trim(preg_replace('/\s+/u', ' ', mb_strtolower($testo)));
    }
}
