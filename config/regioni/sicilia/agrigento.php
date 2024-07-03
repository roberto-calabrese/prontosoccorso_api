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
            'title' => 'Codice Rosso',
            'align' => 'end',
            'key' => 'data.data.rosso.value'
        ],
        [
            'title' => 'Codice Arancione',
            'align' => 'end',
            'key' => 'data.data.arancione.value'
        ],
        [
            'title' => 'Codice Giallo',
            'align' => 'end',
            'key' => 'data.data.giallo.value'
        ],
        [
            'title' => 'Codice Verde',
            'align' => 'end',
            'key' => 'data.data.verde.value'
        ],
        [
            'title' => 'Codice Azzurro',
            'align' => 'end',
            'key' => 'data.data.azzurro.value'
        ],
        [
            'title' => 'Codice Bianco',
            'align' => 'end',
            'key' => 'data.data.bianco.value'
        ]
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
      'slug' => 'agrigento',
      'Titolo' => 'Agrigento'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'sicilia.agrigento',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'aspAgrigento' => [
            'cache' => [
                'key' => 'sicilia.agrigento.aspAgrigento',
                'ttlMinute' => 1
            ],
            'url' => 'http://pswall.aspag.it/ps/listaattesa.php',
            'headers' => [
                'Referer' => 'http://www.aspag.it/',
                'User-Agent' => $userAgent,
                'Origin' => 'http://www.aspag.it/',
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'ps_agrigento' => [
                    'id' => 1,
                    'nome' => 'Agrigento',
                    'descrizione' => 'Ospedale Agrigento',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'http://www.aspag.it/index.php/monitoraggio-in-tempo-reale',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(2)',
                        ],
                        'arancione' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(3)',
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(4)',
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(5)',
                        ],
                        'azzurro' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(6)',
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(6)',
                        ]
                    ]
                ],
                'ps_canicatti' => [
                    'id' => 1,
                    'nome' => 'Canicattì',
                    'descrizione' => 'Ospedale Canicattì',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'http://www.aspag.it/index.php/monitoraggio-in-tempo-reale',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(2)',
                        ],
                        'arancione' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(3)',
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(4)',
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(5)',
                        ],
                        'azzurro' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(6)',
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(7)',
                        ]
                    ]
                ],
                'ps_licata' => [
                    'id' => 1,
                    'nome' => 'Licata',
                    'descrizione' => 'Ospedale Licata',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'http://www.aspag.it/index.php/monitoraggio-in-tempo-reale',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(2)',
                        ],
                        'arancione' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(3)',
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(4)',
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(5)',
                        ],
                        'azzurro' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(6)',
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(7)',
                        ]
                    ]
                ],
                'ps_ribera' => [
                    'id' => 1,
                    'nome' => 'Ribera',
                    'descrizione' => 'Ospedale Ribera',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'http://www.aspag.it/index.php/monitoraggio-in-tempo-reale',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(2)',
                        ],
                        'arancione' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(3)',
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(4)',
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(5)',
                        ],
                        'azzurro' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(6)',
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(7)',
                        ]
                    ]
                ],
                'ps_sciacca' => [
                    'id' => 1,
                    'nome' => 'Sciacca',
                    'descrizione' => 'Ospedale Sciacca',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'http://www.aspag.it/index.php/monitoraggio-in-tempo-reale',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(2)',
                        ],
                        'arancione' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(3)',
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(4)',
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(5)',
                        ],
                        'azzurro' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(6)',
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(7)',
                        ]
                    ]
                ],
            ]
        ],
    ]
];
