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
        'slug' => 'firenze',
        'Titolo' => 'Firenze'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'toscana.firenze',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'firenzeUslCentro' => [
            'cache' => [
                'key' => 'toscana.firenze.uslCentro',
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
                'sanGiovanniDiDio' => [
                    'id' => 1,
                    'nome' => 'Firenze - Ospedale San Giovanni di Dio Pronto Soccorso',
                    'descrizione' => 'Si trova presso: Ospedale San Giovanni di Dio - Torregalli',
                    'adulti' => true,
                    'indirizzo' => 'Via Torregalli, 3, 50143 Firenze FI',
                    'telefono' => '055 69321',
                    'email' => '',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+San+Giovanni+di+Dio+Pronto+Soccorso/@43.7574418,11.2034533,700m/data=!3m2!1e3!4b1!4m6!3m5!1s0x132a50dece1ecd95:0x20923eab24fe05e3!8m2!3d43.7574418!4d11.2034533!16s%2Fg%2F11f25snn__?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.7574418',
                        'lng' => '11.2034533',
                    ],
                    'data' => [
                        'name' => 'Ospedale San Giovanni di Dio - Firenze'
                    ],
                ],
                'StMariaNuova' => [
                    'id' => 2,
                    'nome' => 'Firenze - Ospedale Santa Maria Nuova Pronto Soccorso',
                    'descrizione' => 'Ospedale Santa Maria Nuova Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Torregalli, 3, 50143 Firenze FI',
                    'telefono' => '055 693111',
                    'email' => '',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Santa+Maria+Nuova+Pronto+Soccorso/@43.7734519,11.259605,1399m/data=!3m2!1e3!4b1!4m6!3m5!1s0x132a5403d376289f:0x21708120bed83250!8m2!3d43.7734519!4d11.259605!16s%2Fg%2F12hlqnqq8?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.7734519',
                        'lng' => '11.259605',
                    ],
                    'replaceSearch' => '/\#R/',
                    'replaceTo' => [14],
                    'data' => [
                        'name' => 'Ospedale Santa Maria Nuova - Firenze'
                    ],
                ],
                'SantaMariaAnnunziata' => [
                    'id' => 3,
                    'nome' => 'Bagno a Ripoli - Ospedale Santa Maria Annunziata',
                    'descrizione' => 'Ospedale Santa Maria Annunziata',
                    'adulti' => true,
                    'indirizzo' => 'Via Antella, 58, 50012 Bagno a Ripoli FI',
                    'telefono' => '055 69361',
                    'email' => 'direzionesanitaria.sma@uslcentro.toscana.it',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.com/maps/place/Ospedale+Santa+Maria+Annunziata/@43.7321241,11.3056594,17z/data=!3m1!4b1!4m6!3m5!1s0x132a53066f7aa449:0x37f740c4dcc0a31!8m2!3d43.7321241!4d11.3056594!16s%2Fg%2F119v61yys?entry=ttu&g_ep=EgoyMDI1MTIwOS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.7321241',
                        'lng' => '11.3056594',
                    ],
                    'data' => [
                        'name' => 'Ospedale Santa Maria Annunziata - Bagno a Ripoli'
                    ],
                ],
                'SanGiuseppeEmpoli' => [
                    'id' => 4,
                    'nome' => 'Empoli - Ospedale San Giuseppe',
                    'descrizione' => 'Ospedale San Giuseppe di Empoli',
                    'adulti' => true,
                    'indirizzo' => 'Viale Giovanni Boccaccio, 16, 50053 Empoli FI',
                    'telefono' => '0571 7051',
                    'email' => 'direzionesanitaria.sg@uslcentro.toscana.it',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.com/maps/place/Ospedale+San+Giuseppe+di+Empoli/@43.7222153,10.9340379,16z/data=!3m1!4b1!4m6!3m5!1s0x132a6880304ee9f5:0xa2fbeb2e2cb2a93b!8m2!3d43.7222153!4d10.9340379!16s%2Fg%2F1vlcyzrt?entry=ttu&g_ep=EgoyMDI1MTIwOS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.7222153',
                        'lng' => '10.9340379',
                    ],
                    'data' => [
                        'name' => 'Ospedale San Giuseppe - Empoli'
                    ],
                ],
                'Mugello' => [
                    'id' => 5,
                    'nome' => 'Borgo San Lorenzo - Nuovo Ospedale del Mugello',
                    'descrizione' => 'Nuovo Ospedale del Mugello',
                    'adulti' => true,
                    'indirizzo' => 'Viale della Resistenza, 60, 50032 Borgo San Lorenzo FI',
                    'telefono' => '055 84511',
                    'email' => 'direzionesanitaria.mugello@uslcentro.toscana.it',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.com/maps/place/Ospedale+del+Mugello/@43.9584307,11.3752875,16z/data=!3m1!4b1!4m6!3m5!1s0x132b02ef3296a4e3:0xda128eda59c57680!8m2!3d43.9584307!4d11.3752875!16s%2Fg%2F126299n0l?entry=ttu&g_ep=EgoyMDI1MTIwOS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.9584307',
                        'lng' => '11.3752875',
                    ],
                    'data' => [
                        'name' => 'Nuovo Ospedale del Mugello - Borgo San Lorenzo'
                    ],
                ],
            ]
        ],
    ]
];
