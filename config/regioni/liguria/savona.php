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
      'slug' => 'savona',
      'Titolo' => 'Savona'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'liguria.savona',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'st_maria_misericordia' => [
            'cache' => [
                'key' => 'sicilia.liguria.savona.st_maria_misericordia',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07021101',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'st_maria_misericordia' => [
                    'id' => 1,
                    'nome' => 'Albenga - Santa Maria di Misericordia',
                    'descrizione' => 'Ospedale Santa Maria di Misericordia - Albenga',
                    'adulti' => true,
                    'indirizzo' => 'Viale Martiri della Foce, Albenga - SV',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Santa+Maria+di+Misericordia/@44.0546714,8.1995313,16z/data=!3m1!4b1!4m6!3m5!1s0x12d25ec2702aa2f3:0x34b861620d59aa38!8m2!3d44.0546714!4d8.1995313!16s%2Fg%2F11b620g6zy?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 44.0546714,
                        'lng' => 8.1973426,
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ],
        'st_corona' => [
            'cache' => [
                'key' => 'sicilia.liguria.savona.st_corona',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07021102',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'st_corona' => [
                    'id' => 1,
                    'nome' => 'Pietra Ligure - Santa Corona',
                    'descrizione' => 'Presidio Ponente - Ospedale Santa Corona',
                    'adulti' => true,
                    'indirizzo' => 'Viale 25 Aprile 38, Pietra Ligure - SV',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Santa+Corona/@44.1426951,8.270956,17z/data=!3m1!4b1!4m6!3m5!1s0x12d2f70403878357:0x93688d15e8e1e606!8m2!3d44.1426951!4d8.270956!16s%2Fg%2F1ptyjwcbs?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 44.1426951,
                        'lng' => 8.2687673,
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ],
        'st_giuseppe' => [
            'cache' => [
                'key' => 'sicilia.liguria.savona.st_giuseppe',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07021203',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'st_giuseppe' => [
                    'id' => 1,
                    'nome' => 'Cairo Montenotte - San Giuseppe',
                    'descrizione' => 'Ospedale San Giuseppe - Cairo Montenotte',
                    'adulti' => true,
                    'indirizzo' => 'Corso Martiri della Libertà 30, Cairo Montenotte - SV',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+San+Giuseppe/@44.4016957,8.2703056,16z/data=!3m1!4b1!4m6!3m5!1s0x12d2c281f7cb7fa7:0x1c619ab84d9266fb!8m2!3d44.4016957!4d8.2703056!16s%2Fg%2F1tfs813v?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 44.4016706,
                        'lng' => 8.2682556,
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ],
        'st_paolo' => [
            'cache' => [
                'key' => 'sicilia.liguria.savona.st_paolo',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07021204',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'st_paolo' => [
                    'id' => 1,
                    'nome' => 'Savona - San Paolo',
                    'descrizione' => 'Presidio Levante - Ospedale San Paolo',
                    'adulti' => true,
                    'indirizzo' => 'Via Genova 30,Savona - SV',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+San+Paolo/@44.320428,8.4915187,17z/data=!3m1!4b1!4m6!3m5!1s0x12d31e1b564d44ed:0x29f37f2951fe7205!8m2!3d44.320428!4d8.4915187!16s%2Fg%2F11crzw3r7l?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 44.320428,
                        'lng' => 8.48933,
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ],


    ]
];
