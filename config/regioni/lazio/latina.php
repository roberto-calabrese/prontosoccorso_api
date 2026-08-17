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
        'slug' => 'latina',
        'Titolo' => 'Latina'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'lazio.latina',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola query restituisce tutti i pronto soccorso del Lazio: il campo
        // 'codice' e' "STRUTTURA|COMUNE" come compare nel dataset e serve ad
        // abbinare la riga (il solo nome non basta, "Ospedale Civile" si ripete).
        'saluteLazioLatina' => [
            'cache' => [
                'key' => 'lazio.latina',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'powerbi' => $powerbi,
            'jobClass' => \App\Jobs\Lazio\SaluteLazioPowerBiJob::class,
            'data' => [
                'citta_di_aprilia' => [
                    'id' => 1,
                    'codice' => 'Citta\' di Aprilia|Aprilia',
                    'nome' => 'Aprilia - Casa di Cura Città di Aprilia',
                    'descrizione' => 'Pronto soccorso, ASL LT.',
                    'adulti' => true,
                    'indirizzo' => 'Via delle Palme, 04011 Aprilia LT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.5876712,12.6484792',
                    'coords' => [
                        'lat' => '41.5876712',
                        'lng' => '12.6484792',
                    ],
                    'data' => [],
                ],
                'san_giovanni_di_dio' => [
                    'id' => 2,
                    'codice' => 'San Giovanni di Dio|Fondi',
                    'nome' => 'Fondi - Ospedale San Giovanni di Dio',
                    'descrizione' => 'Pronto soccorso, ASL LT.',
                    'adulti' => true,
                    'indirizzo' => 'Via San Magno, 04022 Fondi LT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.3612577,13.4151986',
                    'coords' => [
                        'lat' => '41.3612577',
                        'lng' => '13.4151986',
                    ],
                    'data' => [],
                ],
                'dono_svizzero' => [
                    'id' => 3,
                    'codice' => 'Dono Svizzero|Formia',
                    'nome' => 'Formia - Ospedale Dono Svizzero',
                    'descrizione' => 'DEA di I livello, ASL LT.',
                    'adulti' => true,
                    'indirizzo' => 'Via Appia Lato Napoli, 04023 Formia LT',
                    'telefono' => '0771 7791',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => '',
                    'coords' => [],
                    'data' => [],
                ],
                'i_c_o_t' => [
                    'id' => 4,
                    'codice' => 'I.C.O.T.|Latina',
                    'nome' => 'Latina - I.C.O.T. Istituto Chirurgico Ortopedico Traumatologico',
                    'descrizione' => 'Pronto soccorso specialistico, ASL LT.',
                    'adulti' => true,
                    'indirizzo' => 'Via Franco Faggiana 1668, 04100 Latina LT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.4408788,12.9007567',
                    'coords' => [
                        'lat' => '41.4408788',
                        'lng' => '12.9007567',
                    ],
                    'data' => [],
                ],
                'santa_maria_goretti' => [
                    'id' => 5,
                    'codice' => 'Santa Maria Goretti|Latina',
                    'nome' => 'Latina - Ospedale Santa Maria Goretti',
                    'descrizione' => 'DEA di II livello, ASL LT.',
                    'adulti' => true,
                    'indirizzo' => 'Via Tiziano Vecellio, 04100 Latina LT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.4612896,12.9092837',
                    'coords' => [
                        'lat' => '41.4612896',
                        'lng' => '12.9092837',
                    ],
                    'data' => [],
                ],
                'a_fiorini' => [
                    'id' => 6,
                    'codice' => 'A. Fiorini|Terracina',
                    'nome' => 'Terracina - Ospedale Alfredo Fiorini',
                    'descrizione' => 'Pronto soccorso, ASL LT.',
                    'adulti' => true,
                    'indirizzo' => 'Via Firenze 1, 04019 Terracina LT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.2984276,13.2328332',
                    'coords' => [
                        'lat' => '41.2984276',
                        'lng' => '13.2328332',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
