<?php

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
            'key' => 'data.data.totali.value',
            'order' => 'desc'
        ]
    ]
];

$headers = [
    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    'Accept-Language' => 'it,en-US;q=0.9,en;q=0.8,it-IT;q=0.7',
    'Cache-Control' => 'no-cache',
    'Content-Type' => 'application/x-www-form-urlencoded',
    'Origin' => 'https://salute.regione.veneto.it',
    'Pragma' => 'no-cache',
    'Referer' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36',
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
        // Il portale richiede obbligatoriamente la provincia e restituisce i
        // presidi cinque per pagina: il job segue la paginazione da solo.
        // Il campo 'codice' e' il nome con cui il portale pubblica il presidio
        // ed e' la chiave di abbinamento.
        'salute_regione_veneto' => [
            'cache' => [
                'key' => 'veneto.padova.salute_regione_veneto',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['provincia' => 'PD'],
            'headers' => $headers,
            'jobClass' => \App\Jobs\Veneto\SaluteVenetoScrapeJob::class,
            'data' => [
                'piove_di_sacco' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso Piove di Sacco',
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
                    'data' => [],
                ],
                'abano_terme' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Policlinico Abano Terme',
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
                    'data' => [],
                ],
                'camposampiero' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso Camposampiero',
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
                    'data' => [],
                ],
                'cittadella' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso Cittadella',
                    'nome' => 'Cittadella - ULSS 6 Euganea',
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
                    'data' => [],
                ],
                'sant_antonio' => [
                    'id' => 5,
                    'codice' => 'Pronto Soccorso Ospedale Sant\'Antonio',
                    'nome' => 'Padova - Ospedale Sant\'Antonio',
                    'descrizione' => 'Pronto Soccorso Ospedale Sant\'Antonio',
                    'adulti' => true,
                    'indirizzo' => 'Via Facciolati, 71, Padova, 35127, PD',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.3926851,11.8918117',
                    'coords' => [
                        'lat' => '45.3926851',
                        'lng' => '11.8918117',
                    ],
                    'data' => [],
                ],
                'padova_ao' => [
                    'id' => 6,
                    'codice' => 'Pronto Soccorso Azienda Ospedaliera di Padova',
                    'nome' => 'Padova - Azienda Ospedaliera',
                    'descrizione' => 'Pronto Soccorso Azienda Ospedaliera di Padova',
                    'adulti' => true,
                    'indirizzo' => 'Via Giustiniani, 1, Padova, 35128, PD',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.4028473,11.8869743',
                    'coords' => [
                        'lat' => '45.4028473',
                        'lng' => '11.8869743',
                    ],
                    'data' => [],
                ],
                'padova_ped' => [
                    'id' => 7,
                    'codice' => 'Pronto Soccorso Pediatrico Azienda Ospedaliera di Padova',
                    'nome' => 'Padova - Azienda Ospedaliera Pediatrico',
                    'descrizione' => 'Pronto Soccorso Pediatrico Azienda Ospedaliera di Padova',
                    'adulti' => false,
                    'indirizzo' => 'Via Giustiniani, 1, Padova, 35128, PD',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.4028473,11.8869743',
                    'coords' => [
                        'lat' => '45.4028473',
                        'lng' => '11.8869743',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
