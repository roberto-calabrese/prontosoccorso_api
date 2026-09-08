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
        // Il portale richiede obbligatoriamente la provincia e restituisce i
        // presidi cinque per pagina: il job segue la paginazione da solo.
        // Il campo 'codice' e' il nome con cui il portale pubblica il presidio
        // ed e' la chiave di abbinamento.
        'salute_regione_veneto' => [
            'cache' => [
                'key' => 'veneto.vicenza.salute_regione_veneto',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['provincia' => 'VI'],
            'headers' => $headers,
            'jobClass' => \App\Jobs\Veneto\SaluteVenetoScrapeJob::class,
            'data' => [
                'asiago' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso Asiago',
                    'nome' => 'Asiago - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Asiago',
                    'adulti' => true,
                    'indirizzo' => 'Via Martiri di Granezza, 42, Asiago, 36012, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.8621074,11.5226356',
                    'coords' => [
                        'lat' => '45.8621074',
                        'lng' => '11.5226356',
                    ],
                    'data' => [],
                ],
                'bassano' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Bassano del Grappa',
                    'nome' => 'Bassano del Grappa - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Bassano del Grappa',
                    'adulti' => true,
                    'indirizzo' => 'Via dei Lotti, 40, Bassano del Grappa, 36061, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.7467107,11.7443565',
                    'coords' => [
                        'lat' => '45.7467107',
                        'lng' => '11.7443565',
                    ],
                    'data' => [],
                ],
                'santorso' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso Santorso',
                    'nome' => 'Santorso - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Santorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Garziere, 42, Santorso, 36014, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.7269087,11.4148050',
                    'coords' => [
                        'lat' => '45.7269087',
                        'lng' => '11.4148050',
                    ],
                    'data' => [],
                ],
                'santorso_ped' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso Santorso Pediatrico',
                    'nome' => 'Santorso - Pronto Soccorso Pediatrico',
                    'descrizione' => 'Pronto Soccorso Santorso Pediatrico',
                    'adulti' => false,
                    'indirizzo' => 'Via Garziere, 42, Santorso, 36014, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.7269087,11.4148050',
                    'coords' => [
                        'lat' => '45.7269087',
                        'lng' => '11.4148050',
                    ],
                    'data' => [],
                ],
                'santorso_gin' => [
                    'id' => 5,
                    'codice' => 'Pronto Soccorso Santorso Ginecologico',
                    'nome' => 'Santorso - Pronto Soccorso Ginecologico',
                    'descrizione' => 'Pronto Soccorso Santorso Ginecologico',
                    'adulti' => true,
                    'indirizzo' => 'Via Garziere, 42, Santorso, 36014, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.7269087,11.4148050',
                    'coords' => [
                        'lat' => '45.7269087',
                        'lng' => '11.4148050',
                    ],
                    'data' => [],
                ],
                'lonigo' => [
                    'id' => 6,
                    'codice' => 'Punto Primo Intervento Lonigo',
                    'nome' => 'Lonigo - Punto Primo Intervento',
                    'descrizione' => 'Punto Primo Intervento Lonigo',
                    'adulti' => true,
                    'indirizzo' => 'Via Sisana, Lonigo, 36045, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+Sisana,+36045+Lonigo+VI',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [],
                ],
                'arzignano' => [
                    'id' => 7,
                    'codice' => 'Pronto soccorso Arzignano',
                    'nome' => 'Arzignano - Pronto Soccorso',
                    'descrizione' => 'Pronto soccorso Arzignano',
                    'adulti' => true,
                    'indirizzo' => 'Via del Parco, 1, Arzignano, 36071, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Via+del+Parco,+1,+36071+Arzignano+VI',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [],
                ],
                'valdagno' => [
                    'id' => 8,
                    'codice' => 'Pronto soccorso Valdagno',
                    'nome' => 'Valdagno - Pronto Soccorso',
                    'descrizione' => 'Pronto soccorso Valdagno',
                    'adulti' => true,
                    'indirizzo' => 'Via Galileo Galilei, 1, Valdagno, 36078, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.6468951,11.3081528',
                    'coords' => [
                        'lat' => '45.6468951',
                        'lng' => '11.3081528',
                    ],
                    'data' => [],
                ],
                'vicenza' => [
                    'id' => 9,
                    'codice' => 'Pronto Soccorso Vicenza',
                    'nome' => 'Vicenza - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Vicenza',
                    'adulti' => true,
                    'indirizzo' => 'Viale Rodolfi, 37, Vicenza, 36100, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.5563987,11.5461965',
                    'coords' => [
                        'lat' => '45.5563987',
                        'lng' => '11.5461965',
                    ],
                    'data' => [],
                ],
                'noventa' => [
                    'id' => 10,
                    'codice' => 'Pronto Soccorso Noventa Vicentina',
                    'nome' => 'Noventa Vicentina - Pronto Soccorso',
                    'descrizione' => 'Pronto Soccorso Noventa Vicentina',
                    'adulti' => true,
                    'indirizzo' => 'Via Capo di Sopra, 1, Noventa Vicentina, 36025, VI',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.2930712,11.5356828',
                    'coords' => [
                        'lat' => '45.2930712',
                        'lng' => '11.5356828',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
