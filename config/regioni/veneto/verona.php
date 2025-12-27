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
        'slug' => 'verona',
        'Titolo' => 'Verona'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'veneto.verona',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'verona_ulss9' => [
            'cache' => [
                'key' => 'veneto.verona.ulss9',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['ulss' => '509'],
            'iterateSelector' => '$I',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'bussolengo' => [
                    'id' => 1,
                    'nome' => 'Bussolengo - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Bussolengo',
                    'adulti' => true,
                    'indirizzo' => 'Via Ospedale, 2, Bussolengo, 37012, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Ospedale,+2,+37012+Bussolengo+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'malcesine' => [
                    'id' => 2,
                    'nome' => 'Malcesine - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Malcesine',
                    'adulti' => true,
                    'indirizzo' => 'Via Gardesana, 37, Malcesine, 37018, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Gardesana,+37,+37018+Malcesine+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'legnago' => [
                    'id' => 3,
                    'nome' => 'Legnago - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Legnago',
                    'adulti' => true,
                    'indirizzo' => 'Via Gianella, 1, Legnago, 37045, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Gianella,+1,+37045+Legnago+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'negrar' => [
                    'id' => 4,
                    'nome' => 'Negrar - Sacro Cuore Don G. Calabria',
                    'descrizione' => 'Pronto Soccorso Ospedale Classificato Sacro Cuore Don G. Calabria',
                    'adulti' => true,
                    'indirizzo' => 'Via Don A. Sempreboni, 5, Negrar, 37024, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Don+A.+Sempreboni,+5,+37024+Negrar+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'san_bonifacio' => [
                    'id' => 5,
                    'nome' => 'San Bonifacio - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso San Bonifacio',
                    'adulti' => true,
                    'indirizzo' => 'Via Fontanelle, 18, San Bonifacio, 37047, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Fontanelle,+18,+37047+San+Bonifacio+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
            ]
        ],
        'verona_ao' => [
            'cache' => [
                'key' => 'veneto.verona.ao',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['ulss' => '912'],
            'iterateSelector' => '$I',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'bt_ostetrico' => [
                    'id' => 6,
                    'nome' => 'Verona - Borgo Trento Ostetrico-Ginecologico',
                    'descrizione' => 'Pronto Soccorso Ostetrico-Ginecologico AOUI Verona Osp. B.Trento',
                    'adulti' => true,
                    'indirizzo' => 'Piazzale Stefani, 1, Verona, 37126, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Piazzale+Stefani,+1,+37126+Verona+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'borgo_roma' => [
                    'id' => 7,
                    'nome' => 'Verona - Borgo Roma',
                    'descrizione' => 'Pronto Soccorso AOUI Verona Osp. B.Roma',
                    'adulti' => true,
                    'indirizzo' => 'Piazzale L. A. Scuro, 10, Verona, 37134, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Piazzale+L.+A.+Scuro,+10,+37134+Verona+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'bt_pediatrico' => [
                    'id' => 8,
                    'nome' => 'Verona - Borgo Trento Pediatrico',
                    'descrizione' => 'Pronto Soccorso Pediatrico AOUI Verona Osp. B.Trento',
                    'adulti' => false,
                    'indirizzo' => 'Piazzale Stefani, 1, Verona, 37126, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Piazzale+Stefani,+1,+37126+Verona+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'bt_generale' => [
                    'id' => 9,
                    'nome' => 'Verona - Borgo Trento Generale e Trauma Center',
                    'descrizione' => 'Pronto Soccorso e Trauma Center AOUI Verona Osp. B.Trento',
                    'adulti' => true,
                    'indirizzo' => 'Via Lungadige Attiraglio, 10, Verona, 37124, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Lungadige+Attiraglio,+10,+37124+Verona+VR',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
            ]
        ]
    ]
];
