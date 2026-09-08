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
        'slug' => 'treviso',
        'Titolo' => 'Treviso'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'veneto.treviso',
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
                'key' => 'veneto.treviso.salute_regione_veneto',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['provincia' => 'TV'],
            'headers' => $headers,
            'jobClass' => \App\Jobs\Veneto\SaluteVenetoScrapeJob::class,
            'data' => [
                'castelfranco' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso Castelfranco Veneto',
                    'nome' => 'Castelfranco Veneto - Pronto Soccorso',
                    'descrizione' => 'Castelfranco Veneto - Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via dei Carpani, 16, Castelfranco Veneto, 31033, TV',
                    'telefono' => '0423 732480',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Pronto+soccorso/@45.6769254,11.9314924,547m/data=!3m1!1e3!4m6!3m5!1s0x477929418e33c1a3:0x1de28822159f7a11!8m2!3d45.6767042!4d11.9317063!16s%2Fg%2F1260mrg_2?hl=it&entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.6769254',
                        'lng' => '11.9314924',
                    ],
                    'data' => [],
                ],
                'treviso' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Treviso',
                    'nome' => 'Treviso - Ospedale di Treviso',
                    'descrizione' => 'Ospedale San Martino di Belluno, Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Piazzale dell\'Ospedale, 1, 31100 Treviso TV',
                    'telefono' => '0422 322111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Treviso+Pronto+Soccorso/@45.659649,12.2612371,629m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477949cbea5eeb21:0x4a898d4566aa8b64!8m2!3d45.659649!4d12.2612371!16s%2Fg%2F11f_d7pxpv?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.659649',
                        'lng' => '12.2612371',
                    ],
                    'data' => [],
                ],
                'oderzo' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso Oderzo',
                    'nome' => 'Oderzo - Pronto Soccorso',
                    'descrizione' => 'Presidio Ospedaliero "Giovanni Paolo II" Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Luigi Luzzatti, 45, Oderzo, 31046, TV',
                    'telefono' => '0422 7151',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Oderzo+:+Pronto+Soccorso/@45.7813662,12.4880702,1255m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477943319269339d:0x7387c18d7f9c92e9!8m2!3d45.7813662!4d12.4880702!16s%2Fg%2F11f0kxrbt8?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.7813662',
                        'lng' => '12.4880702',
                    ],
                    'data' => [],
                ],
                'vittorio_veneto' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso Vittorio Veneto',
                    'nome' => 'Vittorio Veneto - Presidio Ospedaliero',
                    'descrizione' => 'Vittorio Veneto - Presidio Ospedaliero',
                    'adulti' => true,
                    'indirizzo' => 'Via Forlanini, 71, Vittorio Veneto, 31029, TV',
                    'telefono' => '0438 665111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+di+Vittorio+Veneto+-+Pronto+Soccorso/@45.9869864,12.3196167,1250m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47791269aada8557:0xaf69b0d7f97c303d!8m2!3d45.9869864!4d12.3196167!16s%2Fg%2F11bw_70thp?hl=it&entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.9869864',
                        'lng' => '12.3196167',
                    ],
                    'data' => [],
                ],
                'conegliano' => [
                    'id' => 5,
                    'codice' => 'Pronto Soccorso Conegliano',
                    'nome' => 'Conegliano - ULSS 2 Marca Trevigiana',
                    'descrizione' => 'Ospedale di Conegliano - ULSS 2 Marca Trevigiana',
                    'adulti' => true,
                    'indirizzo' => 'Via Brigata Bisagno, 4, Conegliano, 31015, TV',
                    'telefono' => '0438 663111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Conegliano+-+ULSS+2+Marca+Trevigiana/@45.8816625,12.290304,1252m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47791507f99ba62d:0xf9897b9cdaa5402c!8m2!3d45.8816625!4d12.290304!16s%2Fg%2F1tcxc0jf?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.8816625',
                        'lng' => '12.290304',
                    ],
                    'data' => [],
                ],
                'montebelluna' => [
                    'id' => 6,
                    'codice' => 'Pronto Soccorso Montebelluna',
                    'nome' => 'Montebelluna - Ospedale San Valentino',
                    'descrizione' => 'Ospedale San Valentino di Montebelluna, ULSS 2 Marca Trevigiana.',
                    'adulti' => true,
                    'indirizzo' => 'Via Monte Archeson, 11, Montebelluna, 31044, TV',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.7769770,12.0355442',
                    'coords' => [
                        'lat' => '45.7769770',
                        'lng' => '12.0355442',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
