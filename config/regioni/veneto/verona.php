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
        // Il portale richiede obbligatoriamente la provincia e restituisce i
        // presidi cinque per pagina: il job segue la paginazione da solo.
        // Il campo 'codice' e' il nome con cui il portale pubblica il presidio
        // ed e' la chiave di abbinamento.
        'salute_regione_veneto' => [
            'cache' => [
                'key' => 'veneto.verona.salute_regione_veneto',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['provincia' => 'VR'],
            'headers' => $headers,
            'jobClass' => \App\Jobs\Veneto\SaluteVenetoScrapeJob::class,
            'data' => [
                'bussolengo' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso Bussolengo',
                    'nome' => 'Bussolengo - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Bussolengo',
                    'adulti' => true,
                    'indirizzo' => 'Via Ospedale, 2, Bussolengo, 37012, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.4757183,10.8492401',
                    'coords' => [
                        'lat' => '45.4757183',
                        'lng' => '10.8492401',
                    ],
                    'data' => [],
                ],
                'malcesine' => [
                    'id' => 2,
                    'codice' => 'Punto Primo Intervento Malcesine',
                    'nome' => 'Malcesine - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Malcesine',
                    'adulti' => true,
                    'indirizzo' => 'Via Gardesana, 37, Malcesine, 37018, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.7515235,10.7968565',
                    'coords' => [
                        'lat' => '45.7515235',
                        'lng' => '10.7968565',
                    ],
                    'data' => [],
                ],
                'negrar' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso Ospedale Classificato Sacro Cuore Don G. Calabria',
                    'nome' => 'Negrar - Sacro Cuore Don G. Calabria',
                    'descrizione' => 'Pronto Soccorso Ospedale Classificato Sacro Cuore Don G. Calabria',
                    'adulti' => true,
                    'indirizzo' => 'Via Don A. Sempreboni, 5, Negrar, 37024, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.5303545,10.9363783',
                    'coords' => [
                        'lat' => '45.5303545',
                        'lng' => '10.9363783',
                    ],
                    'data' => [],
                ],
                'san_bonifacio' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso San Bonifacio',
                    'nome' => 'San Bonifacio - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso San Bonifacio',
                    'adulti' => true,
                    'indirizzo' => 'Via Fontanelle, 18, San Bonifacio, 37047, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.3919432,11.2796303',
                    'coords' => [
                        'lat' => '45.3919432',
                        'lng' => '11.2796303',
                    ],
                    'data' => [],
                ],
                'villafranca' => [
                    'id' => 5,
                    'codice' => 'Pronto Soccorso Villafranca di Verona',
                    'nome' => 'Villafranca di Verona - Ospedale Magalini',
                    'descrizione' => 'Ospedale Marcello Magalini di Villafranca di Verona, ULSS 9 Scaligera.',
                    'adulti' => true,
                    'indirizzo' => 'Via Ospedale Marcello Magalini, 2, Villafranca di Verona, 37069, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.3481672,10.8387288',
                    'coords' => [
                        'lat' => '45.3481672',
                        'lng' => '10.8387288',
                    ],
                    'data' => [],
                ],
                'pederzoli' => [
                    'id' => 6,
                    'codice' => 'Pronto Soccorso Casa di Cura Dott. Pederzoli',
                    'nome' => 'Peschiera del Garda - Casa di Cura Pederzoli',
                    'descrizione' => 'Casa di Cura Dott. Pederzoli di Peschiera del Garda, ospedale classificato ULSS 9 Scaligera.',
                    'adulti' => true,
                    'indirizzo' => 'Via Monte Baldo, 24, Peschiera del Garda, 37019, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.4437519,10.7066937',
                    'coords' => [
                        'lat' => '45.4437519',
                        'lng' => '10.7066937',
                    ],
                    'data' => [],
                ],
                'bt_ostetrico' => [
                    'id' => 7,
                    'codice' => 'Pronto Soccorso Ostetrico-Ginecologico AOUI Verona Osp. B.Trento',
                    'nome' => 'Verona - Borgo Trento Ostetrico-Ginecologico',
                    'descrizione' => 'Pronto Soccorso Ostetrico-Ginecologico AOUI Verona Osp. B.Trento',
                    'adulti' => true,
                    'indirizzo' => 'Piazzale Stefani, 1, Verona, 37126, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.4528634,10.9841333',
                    'coords' => [
                        'lat' => '45.4528634',
                        'lng' => '10.9841333',
                    ],
                    'data' => [],
                ],
                'borgo_roma' => [
                    'id' => 8,
                    'codice' => 'Pronto Soccorso AOUI Verona Osp. B.Roma',
                    'nome' => 'Verona - Borgo Roma',
                    'descrizione' => 'Pronto Soccorso AOUI Verona Osp. B.Roma',
                    'adulti' => true,
                    'indirizzo' => 'Piazzale L. A. Scuro, 10, Verona, 37134, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Piazzale+L.+A.+Scuro,+10,+37134+Verona+VR',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [],
                ],
                'bt_pediatrico' => [
                    'id' => 9,
                    'codice' => 'Pronto Soccorso Pediatrico AOUI Verona Osp. B.Trento',
                    'nome' => 'Verona - Borgo Trento Pediatrico',
                    'descrizione' => 'Pronto Soccorso Pediatrico AOUI Verona Osp. B.Trento',
                    'adulti' => false,
                    'indirizzo' => 'Piazzale Stefani, 1, Verona, 37126, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.4528634,10.9841333',
                    'coords' => [
                        'lat' => '45.4528634',
                        'lng' => '10.9841333',
                    ],
                    'data' => [],
                ],
                'bt_generale' => [
                    'id' => 10,
                    'codice' => 'Pronto Soccorso e Trauma Center AOUI Verona Osp. B.Trento',
                    'nome' => 'Verona - Borgo Trento Generale e Trauma Center',
                    'descrizione' => 'Pronto Soccorso e Trauma Center AOUI Verona Osp. B.Trento',
                    'adulti' => true,
                    'indirizzo' => 'Via Lungadige Attiraglio, 10, Verona, 37124, VR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.4530156,10.9819907',
                    'coords' => [
                        'lat' => '45.4530156',
                        'lng' => '10.9819907',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
