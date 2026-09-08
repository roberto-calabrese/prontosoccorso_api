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
        'slug' => 'belluno',
        'Titolo' => 'Belluno'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'veneto.belluno',
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
                'key' => 'veneto.belluno.salute_regione_veneto',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['provincia' => 'BL'],
            'headers' => $headers,
            'jobClass' => \App\Jobs\Veneto\SaluteVenetoScrapeJob::class,
            'data' => [
                'feltre' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso Feltre',
                    'nome' => 'Feltre - Pronto Soccorso',
                    'descrizione' => 'Ospedale di Feltre - ULSS 1 Dolomiti , Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Bagnols Sur Ceze, 3, Feltre, 32032, BL',
                    'telefono' => '0439 883221',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Feltre+-+ULSS+1+Dolomiti+,+Pronto+Soccorso/@46.0225149,11.9071985,625m/data=!3m2!1e3!4b1!4m6!3m5!1s0x4778e36446c84923:0x63db8ecccee6b037!8m2!3d46.0225149!4d11.9071985!16s%2Fg%2F11gb3sk4jw?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '46.0225149',
                        'lng' => '11.9071985',
                    ],
                    'data' => [],
                ],
                'belluno' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Belluno',
                    'nome' => 'Belluno - Ospedale San Martino',
                    'descrizione' => 'Ospedale San Martino di Belluno, Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Viale Europa, 22, Belluno, 32100, BL',
                    'telefono' => '0437 516125',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+San+Martino+di+Belluno,+Pronto+Soccorso/@46.1394308,12.2016004,623m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477907a9b992ada9:0xf9ae80c1817ed79d!8m2!3d46.1394308!4d12.2016004!16s%2Fg%2F1pp2x82pm?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '46.1394308',
                        'lng' => '12.2016004',
                    ],
                    'data' => [],
                ],
                'pieve_di_cadore' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso Pieve di Cadore',
                    'nome' => 'Pieve di Cadore - Presidio Ospedaliero "Giovanni Paolo II"',
                    'descrizione' => 'Presidio Ospedaliero "Giovanni Paolo II" Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Cogonie, 30, Pieve di Cadore, 32044, BL',
                    'telefono' => '0435 341332',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+%22Giovanni+Paolo+II%22+Pronto+Soccorso/@46.4314996,12.3762073,620m/data=!3m2!1e3!4b1!4m6!3m5!1s0x4779b7876d21b7cb:0xca68e64fb2fe1ac2!8m2!3d46.4314996!4d12.3762073!16s%2Fg%2F11f263t4tt?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '46.4314996',
                        'lng' => '12.3762073',
                    ],
                    'data' => [],
                ],
                'agordo' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso Agordo',
                    'nome' => 'Agordo - ULSS 1 Dolomiti',
                    'descrizione' => 'ULSS 1 Dolomiti - Ospedale di Agordo',
                    'adulti' => true,
                    'indirizzo' => 'Via Fontana, 36, Agordo, 32021, BL',
                    'telefono' => '0437 645111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/ULSS+1+Dolomiti+-+Ospedale+di+Agordo/@46.2835934,12.0388018,622m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477853950fa0c28b:0x71875a8437b6e8e6!8m2!3d46.2835934!4d12.0388018!16s%2Fg%2F1v299vh_?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '46.2835934',
                        'lng' => '12.0388018',
                    ],
                    'data' => [],
                ],
                'auronzo' => [
                    'id' => 5,
                    'codice' => 'Punto Primo Intervento Auronzo',
                    'nome' => 'Auronzo - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Auronzo',
                    'adulti' => true,
                    'indirizzo' => 'Via Ospitale, 1, Auronzo, 32041, BL',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=46.5533646,12.4403668',
                    'coords' => [
                        'lat' => '46.5533646',
                        'lng' => '12.4403668',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
