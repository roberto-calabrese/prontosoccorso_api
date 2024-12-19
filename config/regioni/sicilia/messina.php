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

$dataCommons = [
    'rosso' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(2)>div:nth-child(1)>div>div',
        'extra' => [
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(3)>div:nth-child(1)>div>div',
            ],
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(2)>div:nth-child(1)>div>div',
            ]
        ]
    ],
    'giallo' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(2)>div:nth-child(2)>div>div',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(2)>div:nth-child(2)>div>div',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(3)>div:nth-child(2)>div>div',
            ],
        ]
    ],
    'verde' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(2)>div:nth-child(3)>div>div',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(2)>div:nth-child(3)>div>div',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(3)>div:nth-child(3)>div>div',
            ],
        ]
    ],
    'bianco' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(2)>div:nth-child(4)>div>div',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(2)>div:nth-child(4)>div>div',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(3)>div:nth-child(4)>div>div',
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
                ]
            ]
        ],
    ]
];

return [
    'meta' => [
        'slug' => 'messina',
        'Titolo' => 'Messina'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'sicilia.messina',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'aspMessina' => [
            'cache' => [
                'key' => 'sicilia.palermo.aspMessina',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.asp.messina.it/?page_id=125231',
            'headers' => [
                'Referer' => 'https://www.asp.messina.it',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.asp.messina.it',
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'iterateSelector' => '$I',
            'data' => [
                'barcellona_pozzo_di_gotto' => [
                    'id' => 1,
                    'nome' => 'Barcellona Pozzo Di Gotto - "Cutroni-Zodda"',
                    'descrizione' => 'Ospedale "Cutroni-Zodda" - Barcellona Pozzo Di Gotto',
                    'adulti' => true,
                    'indirizzo' => 'Nuovo Presidio Ospedaliero Cutroni Zodda, Via Salvatore Cattafi, Sant Andrea, Via Giorgio Amendola, 162, 98051 Barcellona Pozzo di Gotto ME',
                    'telefono' => '0909751111',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Cutroni-Zodda/@38.1520632,15.2216912,16z/data=!3m1!4b1!4m6!3m5!1s0x13143aab71ff19bb:0x37b3891394d05062!8m2!3d38.1520632!4d15.2216912!16s%2Fg%2F11c3sqmjp_?entry=ttu',
                    'coords' => [
                        'lat' => '38.1520632',
                        'lng' => '15.2216912',
                    ],
                    'data' => $dataCommons,
                ],
                'lipari' => [
                    'id' => 2,
                    'nome' => 'Lipari - Ospedaliero Civile',
                    'descrizione' => 'Presidio Ospedaliero Civile - Lipari',
                    'adulti' => true,
                    'indirizzo' => 'Via S. Anna, 98050 Lipari ME',
                    'telefono' => '09098851',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Civile+di+Lipari/@38.4622956,14.9542607,16z/data=!3m1!4b1!4m6!3m5!1s0x13167968345a5c01:0x6720eea1c1c8a93c!8m2!3d38.4622956!4d14.9542607!16s%2Fg%2F11bbrl623h?entry=ttu',
                    'coords' => [
                        'lat' => '38.4622956',
                        'lng' => '14.9542607',
                    ],
                    'data' => $dataCommons,
                ],
                'milazzo' => [
                    'id' => 3,
                    'nome' => 'Milazzo - Presidio Ospedaliero "Giuseppe Fogliani"',
                    'descrizione' => 'Presidio Ospedaliero "Giuseppe Fogliani" - Milazzo',
                    'adulti' => true,
                    'indirizzo' => 'Contrada Villaggio Grazia, 98057 Milazzo ME',
                    'telefono' => '09092901',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+%22Giuseppe+Fogliani%22/@,17z/data=!3m1!4b1!4m6!3m5!1s0x1314304ddbae5483:0x3920295f42b84990!8m2!3d38.1887555!4d15.2524891!16s%2Fg%2F11bbw_dpmk?entry=ttu',
                    'coords' => [
                        'lat' => '38.1887555',
                        'lng' => '15.2524891',
                    ],
                    'data' => $dataCommons,
                ],
                'taormina' => [
                    'id' => 4,
                    'nome' => 'Taormina - Ospedale "San Vincenzo" Sirina',
                    'descrizione' => 'Ospedale "San Vincenzo" Sirina - Taormina	',
                    'adulti' => true,
                    'indirizzo' => 'Contrada Sirina, 98039 Taormina ME',
                    'telefono' => '09425791',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+%22San+Vincenzo%22/@37.8459587,15.2788757,16z/data=!3m1!4b1!4m6!3m5!1s0x131411ba7e1d3e67:0xa48bcb4cb6dd0431!8m2!3d37.8459587!4d15.2788757!16s%2Fg%2F1pv0zvnph?entry=ttu',
                    'coords' => [
                        'lat' => '37.8459587',
                        'lng' => '15.2788757',
                    ],
                    'data' => $dataCommons,
                ],
                'mistretta' => [
                    'id' => 5,
                    'nome' => 'Mistretta - Presidio Ospedaliero "San Salvatore"',
                    'descrizione' => 'Presidio Ospedaliero "San Salvatore" - Mistretta	',
                    'adulti' => true,
                    'indirizzo' => 'Via Anna Salamone, 99, 98073 Mistretta ME',
                    'telefono' => '0921389111',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+San+Salvatore/@37.9283936,14.3575739,17z/data=!3m1!4b1!4m6!3m5!1s0x1316d7594f518599:0x59bc991e460c756b!8m2!3d37.9283936!4d14.3575739!16s%2Fg%2F11h42pzlgz?entry=ttu',
                    'coords' => [
                        'lat' => '37.928393',
                        'lng' => '14.3575739',
                    ],
                    'data' => $dataCommons,
                ],
                'patti' => [
                    'id' => 6,
                    'nome' => 'Patti - Presidio Ospedaliero "Barone Romeo"',
                    'descrizione' => 'Presidio Ospedaliero "Barone Romeo" - Patti',
                    'adulti' => true,
                    'indirizzo' => 'Via Giuseppe Mazzini, 14, 98066 Patti ME',
                    'telefono' => '0941244111',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Barone+Romeo/@38.1414171,14.9687621,16z/data=!3m1!4b1!4m6!3m5!1s0x13169c5b9425f245:0x2593712b74b93b0a!8m2!3d38.1414171!4d14.9687621!16s%2Fg%2F11cls77t6s?entry=ttu',
                    'coords' => [
                        'lat' => '38.141417',
                        'lng' => '14.9687621',
                    ],
                    'data' => $dataCommons,
                ],
                'st_militello' => [
                    'id' => 7,
                    'nome' => 'Sant\'Agata Di Militello - Presidio Ospedaliero Sant\'Agata Militello',
                    'descrizione' => 'Presidio Ospedaliero Sant\'Agata Militello - Sant\'Agata Di Militello',
                    'adulti' => true,
                    'indirizzo' => 'Via G. Medici, 98076 Sant\'Agata di Militello ME',
                    'telefono' => '09417201',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Sant\'Agata+di+Militello/@38.0663717,14.6273949,16z/data=!3m1!4b1!4m6!3m5!1s0x1316c0270c56364d:0x80b4b070356e192b!8m2!3d38.0663717!4d14.6273949!16s%2Fg%2F1pp2tk44h?entry=ttu',
                    'coords' => [
                        'lat' => '38.0663717',
                        'lng' => '14.6273949',
                    ],
                    'data' => $dataCommons,
                ],
            ]
        ],
    ]
];
