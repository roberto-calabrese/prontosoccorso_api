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
        'slug' => 'frosinone',
        'Titolo' => 'Frosinone'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'lazio.frosinone',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola query restituisce tutti i pronto soccorso del Lazio: il campo
        // 'codice' e' "STRUTTURA|COMUNE" come compare nel dataset e serve ad
        // abbinare la riga (il solo nome non basta, "Ospedale Civile" si ripete).
        'saluteLazioFrosinone' => [
            'cache' => [
                'key' => 'lazio.frosinone',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'powerbi' => $powerbi,
            'jobClass' => \App\Jobs\Lazio\SaluteLazioPowerBiJob::class,
            'data' => [
                'san_benedetto' => [
                    'id' => 1,
                    'codice' => 'San Benedetto|Alatri',
                    'nome' => 'Alatri - Ospedale San Benedetto',
                    'descrizione' => 'Pronto soccorso, ASL FR.',
                    'adulti' => true,
                    'indirizzo' => 'Monte Calvarola, 03011 Alatri FR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.7376090,13.3344057',
                    'coords' => [
                        'lat' => '41.7376090',
                        'lng' => '13.3344057',
                    ],
                    'data' => [],
                ],
                'santa_scolastica' => [
                    'id' => 2,
                    'codice' => 'Santa Scolastica|Cassino',
                    'nome' => 'Cassino - Ospedale Santa Scolastica',
                    'descrizione' => 'DEA di I livello, ASL FR.',
                    'adulti' => true,
                    'indirizzo' => 'Via Filieri, 03043 Cassino FR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.5054451,13.8434294',
                    'coords' => [
                        'lat' => '41.5054451',
                        'lng' => '13.8434294',
                    ],
                    'data' => [],
                ],
                'f_spaziani' => [
                    'id' => 3,
                    'codice' => 'F. Spaziani|Frosinone',
                    'nome' => 'Frosinone - Ospedale Fabrizio Spaziani',
                    'descrizione' => 'DEA di I livello, ASL FR.',
                    'adulti' => true,
                    'indirizzo' => 'Via Armando Fabi, 03100 Frosinone FR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.6384350,13.3180460',
                    'coords' => [
                        'lat' => '41.6384350',
                        'lng' => '13.3180460',
                    ],
                    'data' => [],
                ],
                'santissima_trinita' => [
                    'id' => 4,
                    'codice' => 'Santissima Trinita\'|Sora',
                    'nome' => 'Sora - Ospedale Santissima Trinità',
                    'descrizione' => 'DEA di I livello, ASL FR.',
                    'adulti' => true,
                    'indirizzo' => 'Strada regionale 666 di Sora, 03039 Sora FR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.7296991,13.6362634',
                    'coords' => [
                        'lat' => '41.7296991',
                        'lng' => '13.6362634',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
