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
        'slug' => 'rovigo',
        'Titolo' => 'Rovigo'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'veneto.rovigo',
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
                'key' => 'veneto.rovigo.salute_regione_veneto',
                'ttlMinute' => 1
            ],
            'url' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso?p_p_id=PRONTOSOCCORSO_WAR_portalprontosoccorso_INSTANCE_o0QZ&p_p_lifecycle=1&p_p_state=normal&p_p_mode=view&p_p_col_id=column-3&p_p_col_count=1',
            'method' => 'POST',
            'form_params' => ['provincia' => 'RO'],
            'headers' => $headers,
            'jobClass' => \App\Jobs\Veneto\SaluteVenetoScrapeJob::class,
            'data' => [
                'trecenta' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso P.O. di Trecenta',
                    'nome' => 'Trecenta - Ospedale San Luca',
                    'descrizione' => 'Ospedale San Luca Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Viale Ugo Grisetti, 265, 45027 Trecenta RO',
                    'telefono' => '0425 725316',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+San+Luca+Pronto+Soccorso/@45.0295914,11.4673534,636m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477f075c4e3b248d:0x151eefc99fe30f65!8m2!3d45.0295914!4d11.4673534!16s%2Fg%2F11gbffq4zf?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.0295914',
                        'lng' => '11.4673534',
                    ],
                    'data' => [],
                ],
                'porto_viro' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Casa di Cura Madonna della Salute',
                    'nome' => 'Porto Viro - Casa di cura Madonna della salute',
                    'descrizione' => 'Pronto soccorso - casa di cura Madonna della salute',
                    'adulti' => true,
                    'indirizzo' => 'Via Giuseppe di Vittorio, 45, 45014 Porto Viro RO',
                    'telefono' => '0437 516125',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Pronto+soccorso+-+casa+di+cura+Madonna+della+salute/@45.0266499,12.2240419,636m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477e8587162a66ed:0x99c9bbf886b376f4!8m2!3d45.0266499!4d12.2240419!16s%2Fg%2F11jqx2dt33?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.0266499',
                        'lng' => '12.2240419',
                    ],
                    'data' => [],
                ],
                'rovigo' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso P.O. di Rovigo',
                    'nome' => 'Rovigo - Ospedale Santa Maria della Misericordia',
                    'descrizione' => 'Ospedale Santa Maria della Misericordia',
                    'adulti' => true,
                    'indirizzo' => 'Viale Tre Martiri, 140, 45100 Rovigo RO',
                    'telefono' => '0425 3931',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Santa+Maria+della+Misericordia/@45.071969,11.8159052,635m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477ef0b77587b113:0x5959d89e2cd6d030!8m2!3d45.071969!4d11.8159052!16s%2Fg%2F1td5_kqn?hl=it&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.071969',
                        'lng' => '11.8159052',
                    ],
                    'data' => [],
                ],
                'adria' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso P.O. di Adria',
                    'nome' => 'Adria - Santa Maria Regina degli Angeli',
                    'descrizione' => 'Santa Maria Regina degli Angeli, Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Piazzale degli Etruschi, 9, 45011 Adria RO',
                    'telefono' => '0426 940111',
                    'email' => '',
                    'web' => 'https://salute.regione.veneto.it/servizi/situazione-nei-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Santa+Maria+Regina+degli+Angeli,+Pronto+Soccorso/@45.0480893,12.0550679,636m/data=!3m2!1e3!4b1!4m6!3m5!1s0x477e8c128c8decb5:0x3b9fcbdd9dffc925!8m2!3d45.0480893!4d12.0550679!16s%2Fg%2F11gbf8g6yg?hl=it&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.0480893',
                        'lng' => '12.0550679',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
