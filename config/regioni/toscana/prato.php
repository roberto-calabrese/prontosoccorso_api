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
        'slug' => 'prato',
        'Titolo' => 'Prato'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'toscana.prato',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'pratoUslCentro' => [
            'cache' => [
                'key' => 'toscana.prato.uslCentro',
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
                'SantoStefano' => [
                    'id' => 1,
                    'nome' => 'Prato - Nuovo Ospedale S. Stefano',
                    'descrizione' => 'Nuovo Ospedale S. Stefano di Prato',
                    'adulti' => true,
                    'indirizzo' => 'Via Suor Niccolina Infermiera, 20/22, 59100 Prato PO',
                    'telefono' => '0574 801111',
                    'email' => 'direzionesanitaria.ss@uslcentro.toscana.it',
                    'web' => 'https://www.uslcentro.toscana.it/psstat/pronto-soccorso-pa.php',
                    'google_maps' => 'https://www.google.com/maps/place/Nuovo+Ospedale+di+Prato+-+S.+Stefano/@43.8906812,11.0643568,17z/data=!3m1!4b1!4m6!3m5!1s0x132af5da76b9f367:0xf7539695ca900666!8m2!3d43.8906812!4d11.0643568!16s%2Fg%2F1pp2vlrnv?entry=ttu&g_ep=EgoyMDI1MTIwOS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '43.8906812',
                        'lng' => '11.0643568',
                    ],
                    'data' => [
                        'name' => 'Nuovo Ospedale S. Stefano - Prato'
                    ],
                ],
            ]
        ]
    ]
];
