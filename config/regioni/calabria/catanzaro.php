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

$dataCommon = [
    'rosso' => [
        'label' => 'Rosso',
        'value' => 0,
        'selector' => 'table tr:nth-of-type(1) td:nth-of-type(3) p',
        'extra' => [
            'in_visita' => [
                'label' => 'Pazienti in visita',
                'selector' => 'table tr:nth-of-type(1) td:nth-of-type(2) p',
            ],
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table tr:nth-of-type(1) td:nth-of-type(3) p',
            ],
            'attesa_media' => [
                'label' => 'Attesa media',
                'selector' => 'table tr:nth-of-type(1) td:nth-of-type(4) p',
                'is_string' => true,
            ]
        ]
    ],
    'arancione' => [
        'label' => 'Arancione',
        'value' => 0,
        'selector' => 'table tr:nth-of-type(2) td:nth-of-type(3) p',
        'extra' => [
            'in_visita' => [
                'label' => 'Pazienti in visita',
                'selector' => 'table tr:nth-of-type(2) td:nth-of-type(2) p',
            ],
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table tr:nth-of-type(2) td:nth-of-type(3) p',
            ],
            'attesa_media' => [
                'label' => 'Attesa media',
                'selector' => 'table tr:nth-of-type(2) td:nth-of-type(4) p',
                'is_string' => true,
            ]
        ]
    ],
    'azzurro' => [
        'label' => 'Azzurro',
        'value' => 0,
        'selector' => 'table tr:nth-of-type(3) td:nth-of-type(3) p',
        'extra' => [
            'in_visita' => [
                'label' => 'Pazienti in visita',
                'selector' => 'table tr:nth-of-type(3) td:nth-of-type(2) p',
            ],
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table tr:nth-of-type(3) td:nth-of-type(3) p',
            ],
            'attesa_media' => [
                'label' => 'Attesa media',
                'selector' => 'table tr:nth-of-type(3) td:nth-of-type(4) p',
                'is_string' => true,
            ]
        ]
    ],
    'verde' => [
        'label' => 'Verde',
        'value' => 0,
        'selector' => 'table tr:nth-of-type(4) td:nth-of-type(3) p',
        'extra' => [
            'in_visita' => [
                'label' => 'Pazienti in visita',
                'selector' => 'table tr:nth-of-type(4) td:nth-of-type(2) p',
            ],
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table tr:nth-of-type(4) td:nth-of-type(3) p',
            ],
            'attesa_media' => [
                'label' => 'Attesa media',
                'selector' => 'table tr:nth-of-type(4) td:nth-of-type(4) p',
                'is_string' => true,
            ]
        ]
    ],
    'bianco' => [
        'label' => 'Bianco',
        'value' => 0,
        'selector' => 'table tr:nth-of-type(5) td:nth-of-type(3) p',
        'extra' => [
            'in_visita' => [
                'label' => 'Pazienti in visita',
                'selector' => 'table tr:nth-of-type(5) td:nth-of-type(2) p',
            ],
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'table tr:nth-of-type(5) td:nth-of-type(3) p',
            ],
            'attesa_media' => [
                'label' => 'Attesa media',
                'selector' => 'table tr:nth-of-type(5) td:nth-of-type(4) p',
                'is_string' => true,
            ]
        ]
    ],
    'totali' => [
        'action' => [
            'operation' => 'sum',
            'keys' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'value' => null
                ],
                'in_visita' => [
                    'label' => 'Pazienti in visita',
                    'value' => null
                ]
            ]
        ],
    ],
];

return [
    'meta' => [
        'slug' => 'catanzaro',
        'Titolo' => 'Catanzaro'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'calabria.catanzaro',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'pugliese_ciaccio' => [
            'cache' => [
                'key' => 'calabria.catanzaro.pugliese_ciaccio',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.aourenatodulbecco.it/servizi/accessi-pronto-soccorso/',
            'headers' => [
                'User-Agent' => $userAgent,
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'pugliese_ciaccio' => [
                    'id' => 1,
                    'nome' => 'AOU Renato Dulbecco - Presidio "Pugliese"',
                    'descrizione' => 'Azienda Ospedaliero Universitaria "Renato Dulbecco" (ex Pugliese Ciaccio)',
                    'adulti' => true,
                    'indirizzo' => 'Via Vinicio Cortese, 25, 88100 Catanzaro CZ',
                    'telefono' => '0961 883111',
                    'email' => '',
                    'web' => 'https://www.aourenatodulbecco.it/servizi/accessi-pronto-soccorso/',
                    'google_maps' => 'https://www.google.com/maps/place/Azienda+Ospedaliero+Universitaria+%22Renato+Dulbecco%22/@38.9202449,16.5823473,17z/data=!3m1!4b1!4m6!3m5!1s0x1340065246a4e873:0xba473ebd55397468!8m2!3d38.9202449!4d16.5823473!16s%2Fg%2F1twxbn_v?entry=ttu&g_ep=EgoyMDI1MTIwOS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.9202449',
                        'lng' => '16.5823473',
                    ],
                    'data' => $dataCommon,
                ]
            ]
        ]
    ]
];
