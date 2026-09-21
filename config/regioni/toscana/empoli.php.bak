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
        'slug' => 'empoli',
        'Titolo' => 'Empoli'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'toscana.empoli',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'empoliUslCentro' => [
            'cache' => [
                'key' => 'toscana.empoli.uslCentro',
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
                'sanGiuseppeEmpoli' => [
                    'id' => 1,
                    'nome' => 'Empoli - Ospedale San Giuseppe',
                    'descrizione' => 'Si trova presso: Ospedale San Giuseppe',
                    'adulti' => true,
                    'indirizzo' => 'Viale Giovanni Boccaccio, 16/20, 50053 Empoli FI',
                    'telefono' => '0571 7051',
                    'email' => '',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+S.Giuseppe+Pronto+Soccorso/@43.7215166,10.9348309,1400m/data=!3m2!1e3!4b1!4m6!3m5!1s0x132a68806d7fe49f:0x49fc60aa7649cb6a!8m2!3d43.7215166!4d10.9348309!16s%2Fg%2F11f1zlf150?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.7215166',
                        'lng' => '10.9348309',
                    ],
                    'data' => [
                        'name' => 'Ospedale San Giuseppe - Empoli'
                    ],
                ],
            ]
        ],
    ]
];
