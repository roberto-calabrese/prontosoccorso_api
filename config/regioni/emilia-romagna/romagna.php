<?php

$userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36';

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
            'key' => 'data.data.rosso.value',
            'order' => 'desc'
        ]
    ]
];

$commonData = [
    'rosso' => [
        'selector' => 'encountersStatus.openingWait.R.count',
        'default' => 0,
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'encountersStatus.openingWait.R.count',
                'default' => 0,
            ],
            'totale_presenti' => [
                'label' => 'Totale presenti',
                'selector' => 'encountersStatus.opening.R.count',
                'default' => 0,
            ],
            'tempo_medio' => [
                'label' => 'Tempo medio di attesa',
                'selector' => 'encountersStatus.openingWait.R.averageTime',
                'default' => 0,
                'format' => 'minutes_to_time',
            ]
        ]
    ],
    'arancione' => [
        'selector' => 'encountersStatus.openingWait.A.count',
        'default' => 0,
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'encountersStatus.openingWait.A.count',
                'default' => 0,
            ],
            'totale_presenti' => [
                'label' => 'Totale presenti',
                'selector' => 'encountersStatus.opening.A.count',
                'default' => 0,
            ],
            'tempo_medio' => [
                'label' => 'Tempo medio di attesa',
                'selector' => 'encountersStatus.openingWait.A.averageTime',
                'default' => 0,
                'format' => 'minutes_to_time',
            ]
        ]
    ],
    'azzurro' => [
        'selector' => 'encountersStatus.openingWait.Z.count',
        'default' => 0,
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'encountersStatus.openingWait.Z.count',
                'default' => 0,
            ],
            'totale_presenti' => [
                'label' => 'Totale presenti',
                'selector' => 'encountersStatus.opening.Z.count',
                'default' => 0,
            ],
            'tempo_medio' => [
                'label' => 'Tempo medio di attesa',
                'selector' => 'encountersStatus.openingWait.Z.averageTime',
                'default' => 0,
                'format' => 'minutes_to_time',
            ]
        ]
    ],
    'verde' => [
        'selector' => 'encountersStatus.openingWait.V.count',
        'default' => 0,
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'encountersStatus.openingWait.V.count',
                'default' => 0,
            ],
            'totale_presenti' => [
                'label' => 'Totale presenti',
                'selector' => 'encountersStatus.opening.V.count',
                'default' => 0,
            ],
            'tempo_medio' => [
                'label' => 'Tempo medio di attesa',
                'selector' => 'encountersStatus.openingWait.V.averageTime',
                'default' => 0,
                'format' => 'minutes_to_time',
            ]
        ]
    ],
    'bianco' => [
        'selector' => 'encountersStatus.openingWait.B.count',
        'default' => 0,
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'encountersStatus.openingWait.B.count',
                'default' => 0,
            ],
            'totale_presenti' => [
                'label' => 'Totale presenti',
                'selector' => 'encountersStatus.opening.B.count',
                'default' => 0,
            ],
            'tempo_medio' => [
                'label' => 'Tempo medio di attesa',
                'selector' => 'encountersStatus.openingWait.B.averageTime',
                'default' => 0,
                'format' => 'minutes_to_time',
            ]
        ]
    ],
    'totali' => [
        'action' => [
            'operation' => 'sum',
            'keys' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'fields' => [
                        'encountersStatus.openingWait.R.count',
                        'encountersStatus.openingWait.A.count',
                        'encountersStatus.openingWait.Z.count',
                        'encountersStatus.openingWait.V.count',
                        'encountersStatus.openingWait.B.count',
                    ]
                ],
                'totale_presenti' => [
                    'label' => 'Totale presenti',
                    'fields' => [
                        'encountersStatus.opening.R.count',
                        'encountersStatus.opening.A.count',
                        'encountersStatus.opening.Z.count',
                        'encountersStatus.opening.V.count',
                        'encountersStatus.opening.B.count',
                    ]
                ]
            ]
        ]
    ]
];

function buildHospitalData($id, $commonData) {
    $data = $commonData;
    foreach ($data as $key => &$value) {
        if (isset($value['selector'])) {
            $value['selector'] = "$id." . $value['selector'];
        }
        if (isset($value['extra'])) {
            foreach ($value['extra'] as &$extra) {
                if (isset($extra['selector'])) {
                    $extra['selector'] = "$id." . $extra['selector'];
                }
            }
        }
        if ($key === 'totali' && isset($value['action']['keys'])) {
            foreach ($value['action']['keys'] as &$info) {
                $info['fields'] = array_map(function($field) use ($id) {
                    return "$id." . $field;
                }, $info['fields']);
            }
        }
    }
    return $data;
}

return [
    'meta' => [
        'slug' => 'romagna',
        'Titolo' => 'Romagna'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'emilia-romagna.romagna',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'auslRomagna' => [
            'cache' => [
                'key' => 'emilia-romagna.romagna',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.auslromagna.it/++api++/@get-triage-data',
            'method' => 'POST',
            'headers' => [
                'accept' => 'application/json',
                'accept-language' => 'it,en-US;q=0.9,en;q=0.8,it-IT;q=0.7',
                'cache-control' => 'no-cache',
                'content-type' => 'application/json',
                'origin' => 'https://www.auslromagna.it',
                'pragma' => 'no-cache',
                'priority' => 'u=1, i',
                'referer' => 'https://www.auslromagna.it/luoghi/pronto-soccorso/tempi-di-attesa',
                'user-agent' => $userAgent,
            ],
            'body' => [
                'ps_id_list' => ["114-RA","114-FA","114-LU","114-FO","114-CE","114-RN","114-RC"]
            ],
            'transformations' => [
                'key_by' => 'id',
                'path_key_by' => [
                    '*.encountersStatus.opening' => 'code',
                    '*.encountersStatus.openingWait' => 'code',
                ]
            ],
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'ravenna' => [
                    'id' => 1,
                    'nome' => 'Ravenna - Ospedale Santa Maria delle Croci',
                    'descrizione' => 'Pronto Soccorso Ravenna',
                    'adulti' => true,
                    'indirizzo' => 'Viale Vincenzo Randi, 5, 48121 Ravenna RA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.auslromagna.it/luoghi/pronto-soccorso/tempi-di-attesa',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '44.4098',
                        'lng' => '12.1966',
                    ],
                    'data' => buildHospitalData('114-RA', $commonData)
                ],
                'faenza' => [
                    'id' => 2,
                    'nome' => 'Faenza - Ospedale per gli Infermi',
                    'descrizione' => 'Pronto Soccorso Faenza',
                    'adulti' => true,
                    'indirizzo' => 'Viale Stradone, 9, 48018 Faenza RA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.auslromagna.it/luoghi/pronto-soccorso/tempi-di-attesa',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '44.2856',
                        'lng' => '11.8767',
                    ],
                    'data' => buildHospitalData('114-FA', $commonData)
                ],
                'lugo' => [
                    'id' => 3,
                    'nome' => 'Lugo - Ospedale Umberto I',
                    'descrizione' => 'Pronto Soccorso Lugo',
                    'adulti' => true,
                    'indirizzo' => 'Viale Dante Masi, 3, 48022 Lugo RA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.auslromagna.it/luoghi/pronto-soccorso/tempi-di-attesa',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '44.4216',
                        'lng' => '11.9056',
                    ],
                    'data' => buildHospitalData('114-LU', $commonData)
                ],
                'forli' => [
                    'id' => 4,
                    'nome' => 'Forlì - Ospedale Morgagni-Pierantoni',
                    'descrizione' => 'Pronto Soccorso Forlì',
                    'adulti' => true,
                    'indirizzo' => 'Via Carlo Forlanini, 34, 47121 Forlì FC',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.auslromagna.it/luoghi/pronto-soccorso/tempi-di-attesa',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '44.2057',
                        'lng' => '12.0298',
                    ],
                    'data' => buildHospitalData('114-FO', $commonData)
                ],
                'cesena' => [
                    'id' => 5,
                    'nome' => 'Cesena - Ospedale Maurizio Bufalini',
                    'descrizione' => 'Pronto Soccorso Cesena',
                    'adulti' => true,
                    'indirizzo' => 'Viale Giovanni Ghirotti, 286, 47521 Cesena FC',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.auslromagna.it/luoghi/pronto-soccorso/tempi-di-attesa',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '44.1333',
                        'lng' => '12.2477',
                    ],
                    'data' => buildHospitalData('114-CE', $commonData)
                ],
                'rimini' => [
                    'id' => 6,
                    'nome' => 'Rimini - Ospedale Infermi',
                    'descrizione' => 'Pronto Soccorso Rimini',
                    'adulti' => true,
                    'indirizzo' => 'Viale Luigi Settembrini, 2, 47923 Rimini RN',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.auslromagna.it/luoghi/pronto-soccorso/tempi-di-attesa',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '44.0531',
                        'lng' => '12.5768',
                    ],
                    'data' => buildHospitalData('114-RN', $commonData)
                ],
                'riccione' => [
                    'id' => 7,
                    'nome' => 'Riccione - Ospedale Ceccarini',
                    'descrizione' => 'Pronto Soccorso Riccione',
                    'adulti' => true,
                    'indirizzo' => 'Via Frosinone, 47838 Riccione RN',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.auslromagna.it/luoghi/pronto-soccorso/tempi-di-attesa',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '43.9996',
                        'lng' => '12.6517',
                    ],
                    'data' => buildHospitalData('114-RC', $commonData)
                ]
            ]
        ]
    ]
];
