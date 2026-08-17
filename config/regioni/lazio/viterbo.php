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
            'key' => 'data.data.totali.value',
            'order' => 'desc'
        ]
    ]
];


$powerbi = [
    'resourceKey' => env('POWERBI_LAZIO_RESOURCEKEY'),
    'datasetId' => env('POWERBI_LAZIO_DATASETID'),
    'reportId' => env('POWERBI_LAZIO_REPORTID'),
    'visualId' => env('POWERBI_LAZIO_VISUALID'),
    'modelId' => env('POWERBI_LAZIO_MODELID'),
    'entity' => env('POWERBI_LAZIO_ENTITY'),
];

$url = env('POWERBI_LAZIO_URI_API');

$headers = [
    'Accept' => 'application/json, text/plain, */*',
    'Origin' => 'https://app.powerbi.com',
    'Referer' => 'https://app.powerbi.com/',
    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36',
];

return [
    'meta' => [
        'slug' => 'viterbo',
        'Titolo' => 'Viterbo'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'lazio.viterbo',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola query restituisce tutti i pronto soccorso del Lazio: il campo
        // 'codice' e' "STRUTTURA|COMUNE" come compare nel dataset e serve ad
        // abbinare la riga (il solo nome non basta, "Ospedale Civile" si ripete).
        'saluteLazioViterbo' => [
            'cache' => [
                'key' => 'lazio.viterbo',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'powerbi' => $powerbi,
            'jobClass' => \App\Jobs\Lazio\SaluteLazioPowerBiJob::class,
            'data' => [
                'ospedale_civile_acquapendente' => [
                    'id' => 1,
                    'codice' => 'Ospedale Civile|Acquapendente',
                    'nome' => 'Acquapendente - Ospedale Civile',
                    'descrizione' => 'Pronto soccorso, ASL VT.',
                    'adulti' => true,
                    'indirizzo' => '01021 Acquapendente VT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => '',
                    'coords' => [],
                    'data' => [],
                ],
                'andosilla' => [
                    'id' => 2,
                    'codice' => 'Andosilla|Civitacastellana',
                    'nome' => 'Civitacastellana - Ospedale Andosilla',
                    'descrizione' => 'Pronto soccorso, ASL VT.',
                    'adulti' => true,
                    'indirizzo' => 'Via Vincenzo Ferretti, 01033 Civita Castellana VT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=42.2896186,12.4147634',
                    'coords' => [
                        'lat' => '42.2896186',
                        'lng' => '12.4147634',
                    ],
                    'data' => [],
                ],
                'ospedale_civile_tarquinia' => [
                    'id' => 3,
                    'codice' => 'Ospedale Civile|Tarquinia',
                    'nome' => 'Tarquinia - Ospedale Civile',
                    'descrizione' => 'Pronto soccorso, ASL VT.',
                    'adulti' => true,
                    'indirizzo' => 'Via delle Croci, 01016 Tarquinia VT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=42.2511423,11.7611662',
                    'coords' => [
                        'lat' => '42.2511423',
                        'lng' => '11.7611662',
                    ],
                    'data' => [],
                ],
                'belcolle' => [
                    'id' => 4,
                    'codice' => 'Belcolle|Viterbo',
                    'nome' => 'Viterbo - Ospedale Belcolle',
                    'descrizione' => 'DEA di I livello, ASL VT.',
                    'adulti' => true,
                    'indirizzo' => 'Strada Sammartinese, 01100 Viterbo VT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=42.3932741,12.1238576',
                    'coords' => [
                        'lat' => '42.3932741',
                        'lng' => '12.1238576',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
