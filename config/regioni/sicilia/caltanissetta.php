<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

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
            'title' => 'Azzurro in attesa',
            'align' => 'end',
            'key' => 'data.data.azzurro.value'
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

$commonCruscottoAsp = [
    'rosso' => [
        'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(1) > div.badge',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(1) > div.badge',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(2) > td:nth-of-type(1) > div.badge',
            ]
        ]
    ],
    'arancione' => [
        'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(2) > div.badge',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(2) > div.badge',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(2) > td:nth-of-type(2) > div.badge',
            ]
        ]
    ],
    'azzurro' => [
        'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(3) > div.badge',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(3) > div.badge',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(2) > td:nth-of-type(3) > div.badge',
            ]
        ]
    ],
    'verde' => [
        'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(4) > div.badge',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(4) > div.badge',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(2) > td:nth-of-type(4) > div.badge',
            ]
        ]
    ],
    'bianco' => [
        'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(5) > div.badge',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(5) > div.badge',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(2) > td:nth-of-type(5) > div.badge',
            ]
        ]
    ],
    'totali' => [
        'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(6)',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(1) > td:nth-of-type(6)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'html > body > div.container:nth-of-type(1) > div.dashboard:nth-of-type(1) > div.main-table:nth-of-type(1) > table > tbody > tr:nth-of-type(2) > td:nth-of-type(6)',
            ]
        ]
    ]
];

return [
    'meta' => [
      'slug' => 'caltanissetta',
      'Titolo' => 'Caltanissetta',
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'sicilia.caltanissetta',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'caltanissetta' => [
            'cache' => [
                'key' => 'sicilia.caltanissetta.caltanissetta',
                'ttlMinute' => 1
            ],
            'url' => 'https://cruscottops.asp.cl.it/caltanissetta.php',
            'headers' => [
                'Referer' => 'https://www.asp.cl.it/',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.asp.cl.it/',
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'ps_st_elia' => [
                    'id' => 1,
                    'nome' => 'Caltanissetta - S. Elia',
                    'descrizione' => 'Con il proprio mezzo: Per chi proviene dall’autostrada Palermo-Catania o dalla SS 640 Agrigento-Caltanissetta raggiungere l’ospedale è semplice. Basta, infatti, dopo la rotatoria, all’uscita della galleria “S. Elia” immettersi nella vicina via Luigi Monaco, direzione San Cataldo, e percorrere l’arteria fino all’ingresso dell’ospedale (si consiglia di seguire la segnaletica stradale).Con il servizio pubblico:Autobus LINEA N°1 - Percorso: piazza Roma (davanti stazione ferroviaria) villaggio Santa Barbara, ospedale. Intervallo della corsa ogni mezz’ora.LINEA N° 4 - Percorso: piazza Roma (davanti stazione ferroviaria), corso Umberto, corso Vittorio Emanuele, ospedale. Intervallo della corsa ogni 20 minuti.',
                    'adulti' => true,
                    'indirizzo' => 'Via Luigi Russo, 6, 93100 Caltanissetta CL',
                    'telefono' => '0934 559265',
                    'email' => 'protocollo.asp.cl@pec.asp.cl.it',
                    'web' => 'https://www.asp.cl.it/servizi/notizie/notizie_homepage.aspx',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+S.+Elia+Pronto+Soccorso/@37.490566,14.0310056,16z/data=!3m1!4b1!4m6!3m5!1s0x1310c26cafb31199:0xffe667eb48e9d99e!8m2!3d37.490566!4d14.0310056!16s%2Fg%2F11fylsk30s?entry=ttu&g_ep=EgoyMDI0MDkwNC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '37.490566',
                        'lng' => '14.0310056',
                    ],
                    'data' => $commonCruscottoAsp
                ],
            ]
        ],
        'gela' => [
            'cache' => [
                'key' => 'sicilia.caltanissetta.gela',
                'ttlMinute' => 1
            ],
            'url' => 'https://cruscottops.asp.cl.it/gela.php',
            'headers' => [
                'Referer' => 'https://www.asp.cl.it/',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.asp.cl.it/',
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'ps_vittorio_emanuele' => [
                    'id' => 2,
                    'nome' => 'Gela - Vittorio Emanuele',
                    'descrizione' => 'Il Presidio Ospedaliero V. E. ha sede a Gela in via Palazzi n.173Presidio Ospedaliero Vittorio Emanuele - Gela Centralino: 0933/831111 Pronto Soccorso: 0933/930030 Il presidio si trova nella parte nuova della città, in zona Caposoprano, occupa una superficie totale di 185.000 mq. di cui mq. 6.450 coperti e si estende in un’area compresa fra  via Europa, via Palazzi, via  Italia e viale Indipendenza.L’ingresso principale è su via Palazzi, al n. 173; da qui si accede anche al Pronto Soccorso.',
                    'adulti' => true,
                    'indirizzo' => 'Via Palazzi, 173, 93012 Gela CL',
                    'telefono' => '0933 831111',
                    'email' => 'urp.pogela@asp.cl.it',
                    'web' => 'https://www.asp.cl.it/servizi/notizie/notizie_homepage.aspx',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+%E2%80%9C+Vittorio+Emanuele+%E2%80%9D+di+Gela/@37.0733949,14.230387,718m/data=!3m2!1e3!4b1!4m6!3m5!1s0x131055acd491a0d3:0x4cc94ab1b8c4a7d7!8m2!3d37.0733949!4d14.230387!16s%2Fg%2F1tfgrhhf?entry=ttu&g_ep=EgoyMDI0MDkwNC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '37.0733949',
                        'lng' => '14.230387',
                    ],
                    'data' => $commonCruscottoAsp
                ],
            ]
        ],
    ]
];
