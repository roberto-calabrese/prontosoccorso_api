<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

$headers = [
    'Accept' => 'application/json',
    'Accept-Language' => 'it,en-US;q=0.9,en;q=0.8,it-IT;q=0.7',
    'Cache-Control' => 'no-cache',
    'Pragma' => 'no-cache',
    'Priority' => 'u=1, i',
    'Referer' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
    'Sec-CH-UA' => '"Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
    'Sec-CH-UA-Mobile' => '?0',
    'Sec-CH-UA-Platform' => '"macOS"',
    'Sec-Fetch-Dest' => 'empty',
    'Sec-Fetch-Mode' => 'cors',
    'Sec-Fetch-Site' => 'same-origin',
    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'
];

$dataCommons = [
    'rosso' => [
        'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(2)',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(2)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(3)>td:nth-child(2)',
            ],
        ]
    ],
    'arancione' => [
        'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(3)',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(3)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(3)>td:nth-child(3)',
            ],
        ]
    ],
    'giallo' => [
        'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(4)',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(4)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(3)>td:nth-child(4)',
            ],
        ]
    ],
    'verde' => [
        'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(5)',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(5)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(3)>td:nth-child(5)',
            ],
        ]
    ],
    'bianco' => [
        'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(6)',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(2)>td:nth-child(6)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table#ps>tbody>tr:nth-child($I)>td:nth-child(3)>table>tr:nth-child(3)>td:nth-child(6)',
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
        ],
    ]
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

return [
    'meta' => [
        'slug' => 'venezia',
        'Titolo' => 'Venezia'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'veneto.venezia',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'venezia_ulss3' => [
            'cache' => [
                'key' => 'veneto.venezia.ulss3',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['ulss' => '503'],
            'iterateSelector' => '$I',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'dolo' => [
                    'id' => 1,
                    'nome' => 'Venezia - Ospedale Dolo',
                    'descrizione' => 'Ospedale Dolo Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Pasteur, , Dolo, 30031, VE',
                    'telefono' => '041 513 3111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Dolo+Pronto+Soccorso/@45.4228471,12.0687591,631m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477ec898e65b81b7:0x33df88b5d6b5ee4e!8m2!3d45.4228471!4d12.0687591!16s%2Fg%2F11c6sr58_m?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.4228471',
                        'lng' => '12.0687591',
                    ],
                    'data' => $dataCommons,
                ],
                'castello' => [
                    'id' => 2,
                    'nome' => 'Castello - Ospedale SS. Giovanni e Paolo',
                    'descrizione' => 'Ospedale SS. Giovanni e Paolo',
                    'adulti' => true,
                    'indirizzo' => 'Castello, 6777/A, Venezia, 30122, VE',
                    'telefono' => '041 529 4111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+SS.+Giovanni+e+Paolo+-+entrata+dal+campo/@45.4396908,12.3414167,1262m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477eb1df680fb37d:0x8889b20e55022995!8m2!3d45.4396908!4d12.3414167!16s%2Fg%2F1tdzpzlt?hl=it&entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.4396908',
                        'lng' => '12.3414167',
                    ],
                    'data' => $dataCommons,
                ],
                'mirano' => [
                    'id' => 3,
                    'nome' => 'Mirano - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Mirano',
                    'adulti' => true,
                    'indirizzo' => 'Via Don Giacobbe Sartor, 4, Mirano, 30035, VE',
                    'telefono' => '041 579 4831',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Pronto+Soccorso+Mirano/@45.4991076,12.1115116,630m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477ecbc5823259d5:0xbfb770c5cbe0f69d!8m2!3d45.4991076!4d12.1115116!16s%2Fg%2F11gbfb5fp9?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.4991076',
                        'lng' => '12.1115116',
                    ],
                    'data' => $dataCommons,
                ],
                'sottomarina' => [
                    'id' => 4,
                    'nome' => 'Sottomarina-Chioggia - Presidio Ospedaliero',
                    'descrizione' => 'Vittorio Veneto - Presidio Ospedaliero',
                    'adulti' => true,
                    'indirizzo' => 'Str. Madonna Marina, 500, Chioggia, 30015, VE',
                    'telefono' => '041 553 4111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/ULSS3+Serenissima+-+Distretto+di+Chioggia,+Ospedale+Madonna+della+Navicella/@45.1985226,12.2832979,1268m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477e99abf131efff:0x607fa389f7b7729a!8m2!3d45.1985226!4d12.2832979!16s%2Fg%2F126228fgv?hl=it&entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.1985226',
                        'lng' => '12.2832979',
                    ],
                    'data' => $dataCommons,
                ],
                'mestre' => [
                    'id' => 5,
                    'nome' => 'Venezia - Ospedale dell\'Angelo - ULSS 3 Serenissima',
                    'descrizione' => 'Ospedale dell\'Angelo - ULSS 3 Serenissima',
                    'adulti' => true,
                    'indirizzo' => 'Via Paccagnella, 11, Venezia, 30174, VE',
                    'telefono' => '041 965 7111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+dell\'Angelo+-+ULSS+3+Serenissima/@45.513721,12.2232083,1261m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477eb46ac416d80b:0xb4ef84abaa986dd1!8m2!3d45.513721!4d12.2232083!16s%2Fg%2F1tn001ph?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.513721',
                        'lng' => '12.2232083',
                    ],
                    'data' => $dataCommons,
                ],
            ]
        ],
        'venezia_ulss4' => [
            'cache' => [
                'key' => 'veneto.venezia.ulss4',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['ulss' => '504'],
            'iterateSelector' => '$I',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'caorle' => [
                    'id' => 6,
                    'nome' => 'Caorle - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Caorle',
                    'adulti' => true,
                    'indirizzo' => 'Riva dei Bragozzi, 138, Caorle, 30021, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Riva+dei+Bragozzi,+138,+30021+Caorle+VE',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'san_dona' => [
                    'id' => 7,
                    'nome' => 'San Donà di Piave - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso San Donà di Piave',
                    'adulti' => true,
                    'indirizzo' => 'Via Alessandro Girardi, 2, San Donà di Piave, 30027, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Alessandro+Girardi,+2,+30027+San+Don%C3%A0+di+Piave+VE',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'portogruaro' => [
                    'id' => 8,
                    'nome' => 'Portogruaro - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Portogruaro',
                    'adulti' => true,
                    'indirizzo' => 'Via Zappetti, 58, Portogruaro, 30026, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Zappetti,+58,+30026+Portogruaro+VE',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'bibione' => [
                    'id' => 9,
                    'nome' => 'Bibione - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Bibione',
                    'adulti' => true,
                    'indirizzo' => 'Via Maja, 6, Bibione, 30020, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Maja,+6,+30020+Bibione+VE',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
            ]
        ]
    ]
];
