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
        'slug' => 'rieti',
        'Titolo' => 'Rieti'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'lazio.rieti',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola query restituisce tutti i pronto soccorso del Lazio: il campo
        // 'codice' e' "STRUTTURA|COMUNE" come compare nel dataset e serve ad
        // abbinare la riga (il solo nome non basta, "Ospedale Civile" si ripete).
        'saluteLazioRieti' => [
            'cache' => [
                'key' => 'lazio.rieti',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'powerbi' => $powerbi,
            'jobClass' => \App\Jobs\Lazio\SaluteLazioPowerBiJob::class,
            'data' => [
                'san_camillo_de_lellis' => [
                    'id' => 1,
                    'codice' => 'San Camillo De Lellis|Rieti',
                    'nome' => 'Rieti - Ospedale San Camillo De Lellis',
                    'descrizione' => 'DEA di I livello, ASL RI.',
                    'adulti' => true,
                    'indirizzo' => 'Viale J.F. Kennedy, 02100 Rieti RI',
                    'telefono' => '0746 2781',
                    'email' => '',
                    'web' => 'https://www.salutelazio.it/',
                    'google_maps' => '',
                    'coords' => [],
                    'data' => [],
                ],
            ]
        ],
    ]
];
