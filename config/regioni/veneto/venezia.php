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
        // Il portale richiede obbligatoriamente la provincia e restituisce i
        // presidi cinque per pagina: il job segue la paginazione da solo.
        // Il campo 'codice' e' il nome con cui il portale pubblica il presidio
        // ed e' la chiave di abbinamento.
        'salute_regione_veneto' => [
            'cache' => [
                'key' => 'veneto.venezia.salute_regione_veneto',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['provincia' => 'VE'],
            'headers' => $headers,
            'jobClass' => \App\Jobs\Veneto\SaluteVenetoScrapeJob::class,
            'data' => [
                'dolo' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso Dolo',
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
                    'data' => [],
                ],
                'castello' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Ospedaliero e CO - PO Venezia',
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
                    'data' => [],
                ],
                'mirano' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso Mirano',
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
                    'data' => [],
                ],
                'sottomarina' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso Sottomarina-Chioggia',
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
                    'data' => [],
                ],
                'mestre' => [
                    'id' => 5,
                    'codice' => 'Pronto Soccorso Ospedaliero e C.O. - Pronto Soccorso PO Mestre',
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
                    'data' => [],
                ],
                'caorle' => [
                    'id' => 6,
                    'codice' => 'Punto Primo Intervento Caorle',
                    'nome' => 'Caorle - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Caorle',
                    'adulti' => true,
                    'indirizzo' => 'Riva dei Bragozzi, 138, Caorle, 30021, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.6017909,12.8814954',
                    'coords' => [
                        'lat' => '45.6017909',
                        'lng' => '12.8814954',
                    ],
                    'data' => [],
                ],
                'san_dona' => [
                    'id' => 7,
                    'codice' => 'Pronto Soccorso San Donà di Piave',
                    'nome' => 'San Donà di Piave - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso San Donà di Piave',
                    'adulti' => true,
                    'indirizzo' => 'Via Alessandro Girardi, 2, San Donà di Piave, 30027, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.6347942,12.5731257',
                    'coords' => [
                        'lat' => '45.6347942',
                        'lng' => '12.5731257',
                    ],
                    'data' => [],
                ],
                'portogruaro' => [
                    'id' => 8,
                    'codice' => 'Pronto Soccorso Portogruaro',
                    'nome' => 'Portogruaro - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Portogruaro',
                    'adulti' => true,
                    'indirizzo' => 'Via Zappetti, 58, Portogruaro, 30026, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.7699556,12.8420552',
                    'coords' => [
                        'lat' => '45.7699556',
                        'lng' => '12.8420552',
                    ],
                    'data' => [],
                ],
                'jesolo' => [
                    'id' => 9,
                    'codice' => 'Pronto Soccorso Jesolo',
                    'nome' => 'Jesolo - Presidio Ospedaliero',
                    'descrizione' => 'Presidio ospedaliero di Jesolo, ULSS 4 Veneto Orientale.',
                    'adulti' => true,
                    'indirizzo' => 'Via Levantina, 104, Jesolo, 30016, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.5105048,12.6587646',
                    'coords' => [
                        'lat' => '45.5105048',
                        'lng' => '12.6587646',
                    ],
                    'data' => [],
                ],
                'cavallino' => [
                    'id' => 10,
                    'codice' => 'Punto Primo Intervento Cavallino',
                    'nome' => 'Cavallino-Treporti - Punto Primo Intervento',
                    'descrizione' => 'Punto di primo intervento di Ca\' Savio, ULSS 4 Veneto Orientale.',
                    'adulti' => true,
                    'indirizzo' => 'Via Concordia, 33, Ca\'Savio, 30013, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.4538241,12.4549167',
                    'coords' => [
                        'lat' => '45.4538241',
                        'lng' => '12.4549167',
                    ],
                    'data' => [],
                ],
                'bibione' => [
                    'id' => 11,
                    'codice' => 'Punto Primo Intervento Bibione',
                    'nome' => 'Bibione - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Bibione',
                    'adulti' => true,
                    'indirizzo' => 'Via Maja, 6, Bibione, 30020, VE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Maja,+6,+30020+Bibione+VE',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
