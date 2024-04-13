<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

return [
    'meta' => [
      'slug' => 'messina',
      'Titolo' => 'Messina'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'sicilia.messina',
        'event' => 'data'
    ],
    'ospedali' => [
        'aspMessina' => [
            'cache' => [
                'key' => 'sicilia.palermo.aspMessina',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.asp.messina.it/?page_id=125231',
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'barcellona_pozzo_di_gotto' => [
                    'id' => 1,
                    'nome' => 'Ospedale "Cutroni-Zodda"',
                    'descrizione' => 'Ospedale "Cutroni-Zodda" - Barcellona Pozzo Di Gotto',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(2)>div:nth-child(1)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(3)>div:nth-child(1)>div>div',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(2)>div:nth-child(2)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(3)>div:nth-child(2)>div>div',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(2)>div:nth-child(3)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(3)>div:nth-child(3)>div>div',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(2)>div:nth-child(4)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(3)>div:nth-child(4)>div>div',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => '',
                        ],
                    ]
                ],
                'lipari' => [
                    'id' => 1,
                    'nome' => 'Ospedaliero Civile - Lipari',
                    'descrizione' => 'Presidio Ospedaliero Civile - Lipari',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(2)>div:nth-child(1)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(3)>div:nth-child(1)>div>div',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(2)>div:nth-child(2)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(3)>div:nth-child(2)>div>div',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(2)>div:nth-child(3)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(3)>div:nth-child(3)>div>div',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(2)>div:nth-child(4)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(3)>div:nth-child(4)>div>div',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => '',
                        ],
                    ]
                ],
                'milazzo' => [
                    'id' => 1,
                    'nome' => 'Presidio Ospedaliero "Giuseppe Fogliani" - Milazzo',
                    'descrizione' => 'Presidio Ospedaliero "Giuseppe Fogliani" - Milazzo',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(2)>div:nth-child(1)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(3)>div:nth-child(1)>div>div',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(2)>div:nth-child(2)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(3)>div:nth-child(2)>div>div',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(2)>div:nth-child(3)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(3)>div:nth-child(3)>div>div',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(2)>div:nth-child(4)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(3)>div:nth-child(4)>div>div',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => '',
                        ],
                    ]
                ],
                'taormina' => [
                    'id' => 1,
                    'nome' => 'Ospedale "San Vincenzo" Sirina - Taormina',
                    'descrizione' => 'Ospedale "San Vincenzo" Sirina - Taormina	',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(2)>div:nth-child(1)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(3)>div:nth-child(1)>div>div',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(2)>div:nth-child(2)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(3)>div:nth-child(2)>div>div',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(2)>div:nth-child(3)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(3)>div:nth-child(3)>div>div',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(2)>div:nth-child(4)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(3)>div:nth-child(4)>div>div',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => '',
                        ],
                    ]
                ],
                'mistretta' => [
                    'id' => 1,
                    'nome' => 'Presidio Ospedaliero "San Salvatore" - Mistretta	',
                    'descrizione' => 'Presidio Ospedaliero "San Salvatore" - Mistretta	',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(2)>div:nth-child(1)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(3)>div:nth-child(1)>div>div',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(2)>div:nth-child(2)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(3)>div:nth-child(2)>div>div',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(2)>div:nth-child(3)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(3)>div:nth-child(3)>div>div',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(2)>div:nth-child(4)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(5)>td:nth-child(3)>div:nth-child(4)>div>div',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => '',
                        ],
                    ]
                ],
                'patti' => [
                    'id' => 1,
                    'nome' => 'Presidio Ospedaliero "Barone Romeo" - Patti',
                    'descrizione' => 'Presidio Ospedaliero "Barone Romeo" - Patti',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(6)>td:nth-child(2)>div:nth-child(1)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(6)>td:nth-child(3)>div:nth-child(1)>div>div',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(6)>td:nth-child(2)>div:nth-child(2)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(6)>td:nth-child(3)>div:nth-child(2)>div>div',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(6)>td:nth-child(2)>div:nth-child(3)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(6)>td:nth-child(3)>div:nth-child(3)>div>div',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(6)>td:nth-child(2)>div:nth-child(4)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(6)>td:nth-child(3)>div:nth-child(4)>div>div',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => '',
                        ],
                    ]
                ],
                'patti' => [
                    'id' => 1,
                    'nome' => 'Presidio Ospedaliero Sant\'Agata Militello - Sant\'Agata Di Militello',
                    'descrizione' => 'Presidio Ospedaliero Sant\'Agata Militello - Sant\'Agata Di Militello',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.asp.messina.it/?page_id=125231',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(7)>td:nth-child(2)>div:nth-child(1)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(7)>td:nth-child(3)>div:nth-child(1)>div>div',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(7)>td:nth-child(2)>div:nth-child(2)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(7)>td:nth-child(3)>div:nth-child(2)>div>div',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(7)>td:nth-child(2)>div:nth-child(3)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(7)>td:nth-child(3)>div:nth-child(3)>div>div',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(7)>td:nth-child(2)>div:nth-child(4)>div>div',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in carico',
                                    'selector' => 'table.table>tbody>tr:nth-child(7)>td:nth-child(3)>div:nth-child(4)>div>div',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => '',
                        ],
                    ]
                ],
            ]
        ],
    ]
];
