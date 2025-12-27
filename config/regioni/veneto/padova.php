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
        'slug' => 'padova',
        'Titolo' => 'Padova'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'veneto.padova',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'padova_ulss6' => [
            'cache' => [
                'key' => 'veneto.padova.ulss6',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['ulss' => '506'],
            'iterateSelector' => '$I',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'piove_di_sacco' => [
                    'id' => 1,
                    'nome' => 'Piove di Sacco - Pronto Soccorso',
                    'descrizione' => 'Presidio Ospedaliero di Piove di Sacco',
                    'adulti' => true,
                    'indirizzo' => 'Via S. Rocco, 8, 35028 Piove di Sacco PD',
                    'telefono' => '049 971 8111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Piove+di+Sacco+Pronto+Soccorso/@45.2921053,12.0304049,1266m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477ec1b389047eb9:0xcc4246421b876471!8m2!3d45.2921053!4d12.0304049!16s%2Fg%2F11gbfdxtqw?hl=it&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.2921053',
                        'lng' => '12.0304049',
                    ],
                    'data' => $dataCommons,
                ],
                'montagnana' => [
                    'id' => 2,
                    'nome' => 'Montagnana - Punto Primo Intervento',
                    'descrizione' => 'Pronto Soccorso - Punto Primo Intervento Montagnana',
                    'adulti' => true,
                    'indirizzo' => 'Via Lovara, 10, Montagnana, 35044, PD',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Lovara,+10,+35044+Montagnana+PD',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'abano_terme' => [
                    'id' => 3,
                    'nome' => 'Abano Terme - Policlinico',
                    'descrizione' => 'Policlinico Abano Terme Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Cristoforo Colombo, 1, Abano Terme, 35031, PD',
                    'telefono' => '049 822 1211',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Policlinico+Abano+Terme+Pronto+Soccorso/@45.3491652,11.7863037,632m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477edeeaf86e0f19:0x1ef83d3a6362e8ca!8m2!3d45.3491652!4d11.7863037!16s%2Fg%2F11f26rtmkv?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.3491652',
                        'lng' => '11.7863037',
                    ],
                    'data' => $dataCommons,
                ],
                'camposampiero' => [
                    'id' => 4,
                    'nome' => 'Camposampiero - Presidio Ospedaliero',
                    'descrizione' => 'Presidio Ospedaliero "Giovanni Paolo II" Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'via P. Cosma, 5, Camposampiero, 35012, PD',
                    'telefono' => ' 049 932 4118',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedalierio+di+Camposampiero.+Pronto+Soccorso/@45.5641217,11.9279788,630m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477ed33fe4dad70f:0xcf19158373fb1eef!8m2!3d45.5641217!4d11.9279788!16s%2Fg%2F1261r3pff?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.5641217',
                        'lng' => '11.9279788',
                    ],
                    'data' => $dataCommons,
                ],
                'cittadella' => [
                    'id' => 5,
                    'nome' => 'Cittadella - ULSS 6 Euganea ',
                    'descrizione' => 'Ospedale di Cittadella - ULSS 6 Euganea : Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Pilastroni, 35013 Cittadella PD',
                    'telefono' => '049 942 4811',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Cittadella+-+ULSS+6+Euganea+:+Pronto+Soccorso/@45.6474292,11.7886955,1258m/data=!3m2!1e3!4b1!4m6!3m5!1s0x4778d44d71e1ff97:0x27423bd8e6ca42da!8m2!3d45.6474292!4d11.7886955!16s%2Fg%2F11bxdv554q?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.6474292',
                        'lng' => '11.7886955',
                    ],
                    'data' => $dataCommons,
                ],
            ]
        ],
        'padova_ao' => [
            'cache' => [
                'key' => 'veneto.padova.ao',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['ulss' => '901'],
            'iterateSelector' => '$I',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'sant_antonio' => [
                    'id' => 6,
                    'nome' => 'Padova - Ospedale Sant\'Antonio',
                    'descrizione' => 'Pronto Soccorso Ospedale Sant\'Antonio',
                    'adulti' => true,
                    'indirizzo' => 'Via Facciolati, 71, Padova, 35127, PD',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Facciolati,+71,+35127+Padova+PD',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'padova_ao' => [
                    'id' => 7,
                    'nome' => 'Padova - Azienda Ospedaliera',
                    'descrizione' => 'Pronto Soccorso Azienda Ospedaliera di Padova',
                    'adulti' => true,
                    'indirizzo' => 'Via Giustiniani, 1, Padova, 35128, PD',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Giustiniani,+1,+35128+Padova+PD',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
                'padova_ped' => [
                    'id' => 8,
                    'nome' => 'Padova - Azienda Ospedaliera Pediatrico',
                    'descrizione' => 'Pronto Soccorso Pediatrico Azienda Ospedaliera di Padova',
                    'adulti' => false,
                    'indirizzo' => 'Via Giustiniani, 1, Padova, 35128, PD',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Giustiniani,+1,+35128+Padova+PD',
                    'coords' => [],
                    'data' => $dataCommons,
                ],
            ]
        ]
    ]
];
