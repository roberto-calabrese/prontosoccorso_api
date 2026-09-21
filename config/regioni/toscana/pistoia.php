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
            'title' => 'Azzurro in attesa',
            'align' => 'end',
            'key' => 'data.data.azzurro.value'
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
        'slug' => 'pistoia',
        'Titolo' => 'Pistoia'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'toscana.pistoia',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'pistoiaUslCentro' => [
            'cache' => [
                'key' => 'toscana.pistoia.uslCentro',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
            'headers' => [
                'Referer' => 'https://www.uslcentro.toscana.it',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.uslcentro.toscana.it',
            ],
            'jobClass' => \App\Jobs\Toscana\UslCentroScrapeJob::class,
            'data' => [
                'SanJacopo' => [
                    'id' => 1,
                    'nome' => 'Pistoia - Ospedale San Jacopo',
                    'descrizione' => 'Ospedale San Jacopo di Pistoia',
                    'adulti' => true,
                    'indirizzo' => 'Via Ciliegiole, 97, 51100 Pistoia PT',
                    'telefono' => '0573 3521',
                    'email' => 'direzionesanitaria.sj@uslcentro.toscana.it',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.com/maps/place/Ospedale+San+Jacopo/@43.9185872,10.9034996,17z/data=!3m1!4b1!4m6!3m5!1s0x132a8bcdba6f6bc7:0xb9427e3a4cb3e938!8m2!3d43.9185872!4d10.9034996!16s%2Fg%2F12ml2mlpy?entry=ttu&g_ep=EgoyMDI1MTIwOS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.9185872',
                        'lng' => '10.9034996',
                    ],
                    'data' => [
                        'name' => 'Ospedale San Jacopo (PT)'
                    ],
                ],
                'Pacini' => [
                    'id' => 2,
                    'nome' => 'San Marcello Piteglio - P.I.O.T',
                    'descrizione' => 'P.I.O.T Presidio Integrato Ospedale Territorio San Marcello Pistoiese',
                    'adulti' => true,
                    'indirizzo' => 'V. Guglielmo Marconi, 160, 51028 San Marcello Piteglio PT',
                    'telefono' => '0573 63401',
                    'email' => 'direzionesanitaria.sscd@uslcentro.toscana.it',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.com/maps/place/P.I.O.T+Presidio+Integrato+Ospedale+Territorio+San+Marcello+Pistoiese/@44.0561621,10.7883016,730m/data=!3m2!1e3!4b1!4m6!3m5!1s0x132a9abd2ee76c77:0x87c81aa5c37029b6!8m2!3d44.0561621!4d10.7883016!16s%2Fg%2F11b7ffjtm1?entry=ttu&g_ep=EgoyMDI2MDkxNi4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '44.0561621',
                        'lng' => '10.7883016',
                    ],
                    'data' => [
                        'name' => 'L.Pacini S.Marcello P.se (PT)'
                    ],
                ],
                'SSCosmaDamiano' => [
                    'id' => 3,
                    'nome' => 'Pescia - Ospedale SS. Cosma e Damiano',
                    'descrizione' => 'Ospedale SS. Cosma e Damiano di Pescia',
                    'adulti' => true,
                    'indirizzo' => 'Via Cesare Battisti, 2, 51017 Pescia PT',
                    'telefono' => '0572 4601',
                    'email' => 'direzionesanitaria.sscd@uslcentro.toscana.it',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.com/maps/place/Ospedale+Santi+Cosma+e+Damiano/@43.9032734,10.6907946,17z/data=!3m1!4b1!4m6!3m5!1s0x132a80a3ca44b743:0x51bc4f36e1c1d3eb!8m2!3d43.9032734!4d10.6907946!16s%2Fg%2F120wl47z?entry=ttu&g_ep=EgoyMDI1MTIwOS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.9032734',
                        'lng' => '10.6907946',
                    ],
                    'data' => [
                        'name' => 'SS. Cosimo e Damiano Pescia (PT)'
                    ],
                ],
            ]
        ]
    ]
];
