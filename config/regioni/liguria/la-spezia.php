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
        [
            'title' => 'Totali',
            'align' => 'end',
            'key' => 'data.data.totali.value'
        ],
    ],
    'sortBy' => [
        [
            'key' => 'data.data.bianco.value',
            'order' => 'asc'
        ]
    ]
];

$dataCommon = [
    'rosso' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttRos',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttRos',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraRos',
            ]
        ]
    ],
    'arancione' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttAra',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttAra',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraAra',
            ]
        ]
    ],
    'azzurro' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttAzz',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttAzz',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraAzz',
            ]
        ]
    ],
    'verde' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttVer',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttVer',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraVer',
            ]
        ]
    ],
    'bianco' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttBia',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttBia',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraBia',
            ]
        ]
    ],
    'totali' => [
        'action' => [
            'operation' => 'sum',
            'keys' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'fields' => [
                        'prontoSoccorsoAffollamento.numAttRos',
                        'prontoSoccorsoAffollamento.numAttAra',
                        'prontoSoccorsoAffollamento.numAttAzz',
                        'prontoSoccorsoAffollamento.numAttVer',
                        'prontoSoccorsoAffollamento.numAttBia',
                    ],
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'fields' => [
                        'prontoSoccorsoAffollamento.numTraRos',
                        'prontoSoccorsoAffollamento.numTraAra',
                        'prontoSoccorsoAffollamento.numTraAzz',
                        'prontoSoccorsoAffollamento.numTraVer',
                        'prontoSoccorsoAffollamento.numTraBia',
                    ],
                ]
            ]
        ],
    ]
];

return [
    'meta' => [
      'slug' => 'la-spezia',
      'Titolo' => 'La Spezia'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'liguria.la_spezia',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'osp_sant_andrea' => [
            'cache' => [
                'key' => 'sicilia.liguria.la_spezia.osp_sant_andrea',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07005804',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'osp_sant_andrea' => [
                    'id' => 1,
                    'nome' => 'La Spezia -  Ospedale Sant`Andrea',
                    'descrizione' => '"Presidio Ospedaliero Del Levante Ligure - Ospedale Sant`Andrea La Spezia"',
                    'adulti' => true,
                    'indirizzo' => 'Via Vittorio Veneto, 197, 19121 La Spezia SP',
                    'telefono' => '0187 5331',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place//data=!4m2!3m1!1s0x12d4fcbf286118d5:0xaab4aed31148cea?sa=X&ved=1t:8290&ictx=111',
                    'coords' => [
                        'lat' => 44.1111071,
                        'lng' => 9.8285929,
                    ],
                    'data' => [...$dataCommon]

                ],
            ]
        ],
        'osp_san_bartolomeo' => [
            'cache' => [
                'key' => 'sicilia.liguria.la_spezia.osp_san_bartolomeo',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07005801',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'osp_san_bartolomeo' => [
                    'id' => 2,
                    'nome' => 'Sarzana -  Ospedale San Bartolomeo',
                    'descrizione' => '"Presidio Ospedaliero Del Levante Ligure - Stabilimento San Bartolomeo di Sarzana"',
                    'adulti' => true,
                    'indirizzo' => 'Via Cisa, 19038 Santa Caterina, Sarzana SP',
                    'telefono' => '0187 6041',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place//data=!4m2!3m1!1s0x12d51cd618f04a45:0x6a1c3ea8e8561e86?sa=X&ved=1t:8290&ictx=111',
                    'coords' => [
                        'lat' => 44.12098940943782,
                        'lng' => 9.948950646208047,
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ],


    ]
];
