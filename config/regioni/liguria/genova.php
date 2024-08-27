<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

$headers = [
    'Accept' => 'application/json',
    'Accept-Language' => 'it,en-US;q=0.9,en;q=0.8,it-IT;q=0.7',
    'Cache-Control' => 'no-cache',
    'Pragma' => 'no-cache',
    'Priority' => 'u=1, i',
    'Referer' => 'https://pslive.regione.liguria.it/dettaglio/07000103',
    'Sec-CH-UA' => '"Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
    'Sec-CH-UA-Mobile' => '?0',
    'Sec-CH-UA-Platform' => '"macOS"',
    'Sec-Fetch-Dest' => 'empty',
    'Sec-Fetch-Mode' => 'cors',
    'Sec-Fetch-Site' => 'same-origin',
    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'
];

$tableSettings = [
    'headers' => $tableHeaders = [
        [
            'title' => 'Presidio',
            'align' => 'start',
            'key' => 'nome'
        ],
        [
            'title' => 'Rosso in attesa',
            'align' => 'end',
            'key' => 'data.data.rosso.value'
        ],
        [
            'title' => 'Arancione in attesa',
            'align' => 'end',
            'key' => 'data.data.arancione.value'
        ],
        [
            'title' => 'Azzurro in attesa',
            'align' => 'end',
            'key' => 'data.data.azzurro.value'
        ],
        [
            'title' => 'Verde in attesa',
            'align' => 'end',
            'key' => 'data.data.verde.value'
        ],
        [
            'title' => 'Bianco in attesa',
            'align' => 'end',
            'key' => 'data.data.bianco.value'
        ],
    ],
    'sortBy' => [
        [
            'key' => 'data.data.bianco.value',
            'order' => 'asc'
        ]
    ]
];

return [
    'meta' => [
      'slug' => 'genova',
      'Titolo' => 'Genova'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'liguria.genova',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'ops_evangelico' => [
            'cache' => [
                'key' => 'sicilia.liguria.genova.ops_evangelico',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07005102',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'st_maria_misericordia' => [
                    'id' => 1,
                    'nome' => 'Genova Voltri - Ospedale Evangelico',
                    'descrizione' => 'Ospedale Evangelico Internazionale - San Carlo Voltri',
                    'adulti' => true,
                    'indirizzo' => 'Piazzale Gianasso 4,  Genova Voltri - GE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => 44.4300997,
                        'lng' => 8.7432917,
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'prontoSoccorsoAffollamento.numAttRos',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'prontoSoccorsoAffollamento.numTraRos',
                                ]
                            ]
                        ],
                        'arancione' => [
                            'selector' => 'prontoSoccorsoAffollamento.numAttAra',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'prontoSoccorsoAffollamento.numTraAra',
                                ]
                            ]
                        ],
                        'azzurro' => [
                            'selector' => 'prontoSoccorsoAffollamento.numAttAzz',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'prontoSoccorsoAffollamento.numTraAzz',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'prontoSoccorsoAffollamento.numAttVer',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'prontoSoccorsoAffollamento.numTraVer',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'prontoSoccorsoAffollamento.numAttBia',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'prontoSoccorsoAffollamento.numTraBia',
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],


    ]
];
