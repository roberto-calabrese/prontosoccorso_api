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
        'slug' => 'vicenza',
        'Titolo' => 'Vicenza'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'veneto.vicenza',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'vicenza_ulss7' => [
            'cache' => [
                'key' => 'veneto.vicenza.ulss7',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['ulss' => '507'],
            'iterateSelector' => '$I',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'asiago' => [
                    'id' => 1,
                    'nome' => 'Asiago - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Asiago',
                    'adulti' => true,
                    'indirizzo' => 'Via Martiri di Granezza, 42, Asiago, 36012, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Martiri+di+Granezza,+42,+36012+Asiago+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'bassano' => [
                    'id' => 2,
                    'nome' => 'Bassano del Grappa - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Bassano del Grappa',
                    'adulti' => true,
                    'indirizzo' => 'Via dei Lotti, 40, Bassano del Grappa, 36061, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+dei+Lotti,+40,+36061+Bassano+del+Grappa+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'santorso' => [
                    'id' => 3,
                    'nome' => 'Santorso - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Santorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Garziere, 42, Santorso, 36014, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Garziere,+42,+36014+Santorso+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'santorso_ped' => [
                    'id' => 4,
                    'nome' => 'Santorso - Pronto Soccorso Pediatrico',
                    'descrizione' => 'Pronto Soccorso Santorso Pediatrico',
                    'adulti' => false,
                    'indirizzo' => 'Via Garziere, 42, Santorso, 36014, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Garziere,+42,+36014+Santorso+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'santorso_gin' => [
                    'id' => 5,
                    'nome' => 'Santorso - Pronto Soccorso Ginecologico',
                    'descrizione' => 'Pronto Soccorso Santorso Ginecologico',
                    'adulti' => true,
                    'indirizzo' => 'Via Garziere, 42, Santorso, 36014, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Garziere,+42,+36014+Santorso+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
            ]
        ],
        'vicenza_ulss8' => [
            'cache' => [
                'key' => 'veneto.vicenza.ulss8',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['ulss' => '508'],
            'iterateSelector' => '$I',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'lonigo' => [
                    'id' => 6,
                    'nome' => 'Lonigo - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Lonigo',
                    'adulti' => true,
                    'indirizzo' => 'Via Sisana, Lonigo, 36045, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Sisana,+36045+Lonigo+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'arzignano' => [
                    'id' => 7,
                    'nome' => 'Arzignano - Pronto Soccorso',
                    'descrizione' => 'Pronto soccorso Arzignano',
                    'adulti' => true,
                    'indirizzo' => 'Via del Parco, 1, Arzignano, 36071, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+del+Parco,+1,+36071+Arzignano+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'valdagno' => [
                    'id' => 8,
                    'nome' => 'Valdagno - Pronto Soccorso',
                    'descrizione' => 'Pronto soccorso Valdagno',
                    'adulti' => true,
                    'indirizzo' => 'Via Galileo Galilei, 1, Valdagno, 36078, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Galileo+Galilei,+1,+36078+Valdagno+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'vicenza' => [
                    'id' => 9,
                    'nome' => 'Vicenza - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Vicenza',
                    'adulti' => true,
                    'indirizzo' => 'Viale Rodolfi, 37, Vicenza, 36100, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Viale+Rodolfi,+37,+36100+Vicenza+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'noventa' => [
                    'id' => 10,
                    'nome' => 'Noventa Vicentina - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Noventa Vicentina',
                    'adulti' => true,
                    'indirizzo' => 'Via Capo di Sopra, 1, Noventa Vicentina, 36025, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Capo+di+Sopra,+1,+36025+Noventa+Vicentina+VI',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
            ]
        ]
    ]
];
