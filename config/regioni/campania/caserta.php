<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

$headers = [
    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Language' => 'it-IT,it;q=0.9,en-US;q=0.8,en;q=0.7',
    'Cache-Control' => 'no-cache',
    'Pragma' => 'no-cache',
    'User-Agent' => $userAgent
];

$tableSettings = [
    'headers' => [
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
            'key' => 'data.data.rosso.value',
            'order' => 'desc'
        ]
    ]
];

$makeData = function($index) {
    $attesaIndex = $index;
    $visitaIndex = $index + 1;

    return [
        'rosso' => [
            'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(1)',
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(1)',
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'selector' => '#data_emergency > div:nth-child(' . $visitaIndex . ') .value_emergency > div:nth-child(1)',
                ],
            ]
        ],
        'arancione' => [
            'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(2)',
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(2)',
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'selector' => '#data_emergency > div:nth-child(' . $visitaIndex . ') .value_emergency > div:nth-child(2)',
                ],
            ]
        ],
        'azzurro' => [
            'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(3)',
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(3)',
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'selector' => '#data_emergency > div:nth-child(' . $visitaIndex . ') .value_emergency > div:nth-child(3)',
                ],
            ]
        ],
        'verde' => [
            'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(4)',
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(4)',
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'selector' => '#data_emergency > div:nth-child(' . $visitaIndex . ') .value_emergency > div:nth-child(4)',
                ],
            ]
        ],
        'bianco' => [
            'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(5)',
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'selector' => '#data_emergency > div:nth-child(' . $attesaIndex . ') .value_emergency > div:nth-child(5)',
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'selector' => '#data_emergency > div:nth-child(' . $visitaIndex . ') .value_emergency > div:nth-child(5)',
                ],
            ]
        ],
        'totali' => [
            'action' => [
                'operation' => 'sum',
                'keys' => [
                    'in_attesa' => [
                        'label' => 'Pazienti in attesa',
                        'value' => null
                    ],
                    'in_trattamento' => [
                        'label' => 'Pazienti in trattamento',
                        'value' => null
                    ],
                ]
            ]
        ]
    ];
};

return [
    'meta' => [
        'slug' => 'caserta',
        'Titolo' => 'Caserta'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'campania.caserta',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'asl_caserta' => [
            'cache' => [
                'key' => 'campania.caserta.asl_caserta',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.aslcaserta.it/index.php/tempi-di-attesa-pronto-soccorso/',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'piedimonte_matese' => [
                    'id' => 1,
                    'nome' => 'Piedimonte Matese',
                    'descrizione' => 'P.O. Piedimonte Matese',
                    'adulti' => true,
                    'indirizzo' => 'Via Matese, 148, 81016 Piedimonte Matese CE',
                    'telefono' => '0823 544111',
                    'email' => '',
                    'web' => 'https://www.aslcaserta.it/index.php/p-o-piedimonte-matese/',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+di+Piedimonte+Matese/@41.355106,14.373977,17z/data=!3m1!4b1!4m6!3m5!1s0x133a4369e80e1a17:0x5e2b0c159265691f!8m2!3d41.355106!4d14.373977',
                    'coords' => [
                        'lat' => '41.355106',
                        'lng' => '14.373977',
                    ],
                    'data' => $makeData(1),
                ],
                'sessa_aurunca' => [
                    'id' => 2,
                    'nome' => 'Sessa Aurunca - San Rocco',
                    'descrizione' => 'P.O. San Rocco Sessa Aurunca',
                    'adulti' => true,
                    'indirizzo' => 'Via Sessa Mignano, 13, 81037 Sessa Aurunca CE',
                    'telefono' => '0823 934111',
                    'email' => '',
                    'web' => 'https://www.aslcaserta.it/index.php/p-o-sessa-aurunca/',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+San+Rocco/@41.240755,13.930438,17z/data=!3m1!4b1!4m6!3m5!1s0x133a593333333333:0x3333333333333333!8m2!3d41.240755!4d13.930438',
                    'coords' => [
                        'lat' => '41.240755',
                        'lng' => '13.930438',
                    ],
                    'data' => $makeData(5),
                ],
                'aversa' => [
                    'id' => 3,
                    'nome' => 'Aversa - San Giuseppe Moscati',
                    'descrizione' => 'P.O. Moscati Aversa',
                    'adulti' => true,
                    'indirizzo' => 'Via Gramsci, 1, 81031 Aversa CE',
                    'telefono' => '081 5001111',
                    'email' => '',
                    'web' => 'https://www.aslcaserta.it/index.php/p-o-aversa/',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+S.+Giuseppe+Moscati/@40.966453,14.208578,17z/data=!3m1!4b1!4m6!3m5!1s0x133b063333333333:0x3333333333333333!8m2!3d40.966453!4d14.208578',
                    'coords' => [
                        'lat' => '40.966453',
                        'lng' => '14.208578',
                    ],
                    'data' => $makeData(9),
                ],
                'marcianise' => [
                    'id' => 4,
                    'nome' => 'Marcianise - Anastasia Guerriero',
                    'descrizione' => 'P.O. Marcianise',
                    'adulti' => true,
                    'indirizzo' => 'Viale Sossietta Scialla, 81025 Marcianise CE',
                    'telefono' => '0823 690111',
                    'email' => '',
                    'web' => 'https://www.aslcaserta.it/index.php/p-o-marcianise/',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Civile+di+Marcianise/@41.026453,14.300438,17z/data=!3m1!4b1!4m6!3m5!1s0x133a593333333333:0x3333333333333333!8m2!3d41.026453!4d14.300438',
                    'coords' => [
                        'lat' => '41.026453',
                        'lng' => '14.300438',
                    ],
                    'data' => $makeData(13),
                ],
            ]
        ]
    ]
];
