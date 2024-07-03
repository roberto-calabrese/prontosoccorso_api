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
            'title' => 'Codice Rosso',
            'align' => 'end',
            'key' => 'data.data.rosso.value'
        ],
        [
            'title' => 'Codice Arancione',
            'align' => 'end',
            'key' => 'data.data.arancione.value'
        ],
        [
            'title' => 'Codice Azzurro',
            'align' => 'end',
            'key' => 'data.data.azzurro.value'
        ],
        [
            'title' => 'Codice Verde',
            'align' => 'end',
            'key' => 'data.data.verde.value'
        ],
        [
            'title' => 'Codice Bianco',
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
      'slug' => 'imperia',
      'Titolo' => 'Imperia'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'liguria.imperia',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'bordighera' => [
            'cache' => [
                'key' => 'sicilia.liguria.imperia.bordighera',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07000103',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'saint_charles' => [
                    'id' => 1,
                    'nome' => 'Bordighera - Saint Charles',
                    'descrizione' => 'Presidio Ospedaliero Unificato - Stabilimento Ospedaliero di Bordighera - Struttura dedicata a patologie e prestazioni di bassa complessità',
                    'adulti' => true,
                    'indirizzo' => 'Via Aurelia 122 - Bordighera - IM',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '43.78476426198199',
                        'lng' => '7.648010647783196',
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
        'imperia_santagata' => [
            'cache' => [
                'key' => 'sicilia.liguria.imperia.santagata',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07000101',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'santagata' => [
                    'id' => 1,
                    'nome' => 'Imperia - Sant\'Agata',
                    'descrizione' => 'Presidio Ospedaliero Unificato - Stabilimento Ospedaliero di Imperia',
                    'adulti' => true,
                    'indirizzo' => 'Sant\'Agata 57 - Imperia - IM',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => 43.89146010958014,
                        'lng' => 8.030312852818343,
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
        'sanremo_borea' => [
            'cache' => [
                'key' => 'sicilia.liguria.imperia.sanremo_borea',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07000102',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'sanremo_borea' => [
                    'id' => 1,
                    'nome' => 'Sanremo - Giovanni Borea',
                    'descrizione' => 'Presidio Ospedaliero Unificato - Stabilimento Ospedaliero di Sanremo',
                    'adulti' => true,
                    'indirizzo' => 'Via Giovanni Borea 56 - Sanremo - IM',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => 43.822223641864255,
                        'lng' => 7.779106107638991,
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
        ]
    ]
];
