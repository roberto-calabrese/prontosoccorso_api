<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

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
            'title' => 'Giallo in attesa',
            'align' => 'end',
            'key' => 'data.data.giallo.value'
        ],
        [
            'title' => 'Verde in attesa',
            'align' => 'end',
            'key' => 'data.data.verde.value'
        ],
        [
            'title' => 'Azzurro in attesa',
            'align' => 'end',
            'key' => 'data.data.azzurro.value'
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
        'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(2)>div>h4',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(2)>div>h4',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>div:nth-child(#R)>table>tbody>tr:nth-child(1)>th:nth-child(2)>div>h4',
            ]
        ]
    ],
    'giallo' => [
        'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(3)>div>h4',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(3)>div>h4',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(1)>th:nth-child(3)>div>h4',
            ]
        ]
    ],
    'verde' => [
        'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(4)>div>h4',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(4)>div>h4',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(1)>th:nth-child(4)>div>h4',
            ]
        ]
    ],
    'azzurro' => [
        'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(5)>div>h4',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(5)>div>h4',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(1)>th:nth-child(5)>div>h4',
            ]
        ]
    ],
    'bianco' => [
        'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(6)>div>h4',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(2)>td:nth-child(6)>div>h4',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>div:nth-child(#R)>table>tbody tr:nth-child(1)>td:nth-child(6)>div>h4',
            ]
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
        ],
    ]
];

return [
    'meta' => [
        'slug' => 'firenze',
        'Titolo' => 'Firenze'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'toscana.firenze',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'firenzeUslCentro' => [
            'cache' => [
                'key' => 'toscana.firenze.uslCentro',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
            'headers' => [
                'Referer' => 'https://www.uslcentro.toscana.it',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.uslcentro.toscana.it',
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'sanGiovanniDiDio' => [
                    'id' => 1,
                    'nome' => 'Firenze - Ospedale San Giovanni di Dio Pronto Soccorso',
                    'descrizione' => 'Si trova presso: Ospedale San Giovanni di Dio - Torregalli',
                    'adulti' => true,
                    'indirizzo' => 'Via Torregalli, 3, 50143 Firenze FI',
                    'telefono' => '055 69321',
                    'email' => '',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+San+Giovanni+di+Dio+Pronto+Soccorso/@43.7574418,11.2034533,700m/data=!3m2!1e3!4b1!4m6!3m5!1s0x132a50dece1ecd95:0x20923eab24fe05e3!8m2!3d43.7574418!4d11.2034533!16s%2Fg%2F11f25snn__?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.7574418',
                        'lng' => '11.2034533',
                    ],
                    'replaceSearch' => '/\#R/',
                    'replaceTo' => [26],
                    'data' => $dataCommon,
                ],
                'StMariaNuova' => [
                    'id' => 2,
                    'nome' => 'Firenze - Ospedale Santa Maria Nuova Pronto Soccorso',
                    'descrizione' => 'Ospedale Santa Maria Nuova Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Torregalli, 3, 50143 Firenze FI',
                    'telefono' => '055 693111',
                    'email' => '',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Santa+Maria+Nuova+Pronto+Soccorso/@43.7734519,11.259605,1399m/data=!3m2!1e3!4b1!4m6!3m5!1s0x132a5403d376289f:0x21708120bed83250!8m2!3d43.7734519!4d11.259605!16s%2Fg%2F12hlqnqq8?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.7734519',
                        'lng' => '11.259605',
                    ],
                    'replaceSearch' => '/\#R/',
                    'replaceTo' => [14],
                    'data' => $dataCommon,
                ],
            ]
        ],
    ]
];
