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
                    'google_maps' => '',
                    'coords' => [
                        'lat' => 44.0546714,
                        'lng' => 8.1973426,
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
                    'google_maps' => '',
                    'coords' => [
                        'lat' => 44.1426951,
                        'lng' => 8.2687673,
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
                    'google_maps' => '',
                    'coords' => [
                        'lat' => 44.4016706,
                        'lng' => 8.2682556,
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
                    'google_maps' => '',
                    'coords' => [
                        'lat' => 44.320428,
                        'lng' => 8.48933,
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
