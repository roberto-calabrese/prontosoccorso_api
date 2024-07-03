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
            'title' => 'Codice Bianco',
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
            'order' => 'asc'
        ]
    ]
];

return [
    'meta' => [
      'slug' => 'catania',
      'Titolo' => 'Catania'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'sicilia.catania',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'policlinico' => [
            'cache' => [
                'key' => 'sicilia.palermo.policlinico',
                'ttlMinute' => 1
            ],
            'url' => 'https://policlinicorodolicosanmarco.it/',
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'policlinicoRodolico' => [
                    'id' => 1,
                    'nome' => 'AOU Policlinico G. Rodolico Catania - Pronto soccorso generale',
                    'descrizione' => 'AOU Policlinico G. Rodolico Catania - Pronto soccorso generale',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://policlinicorodolicosanmarco.it/',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(3)>div:nth-child(1)>span',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(3)>div:nth-child(1)>span',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(3)>div:nth-child(2)>span',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(3)>div:nth-child(2)>span',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(3)>div:nth-child(3)>span',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(3)>div:nth-child(3)>span',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(3)>div:nth-child(4)>span',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(3)>div:nth-child(4)>span',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(2)>div>p',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'In Trattamento',
                                    'selector' => 'div#DivSmartEUS105>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(2)>div>p',
                                ],
                            ]
                        ],
                    ]
                ],
                'policlinicoSanMarco' => [
                    'id' => 1,
                    'nome' => 'AOU Policlinico S. Marco Catania - Pronto soccorso generale',
                    'descrizione' => 'AOU Policlinico S. Marco Catania - Pronto soccorso generale',
                    'adulti' => true,
                    'indirizzo' => '',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://policlinicorodolicosanmarco.it/',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '',
                        'lng' => '',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(3)>div:nth-child(1)>span',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(3)>div:nth-child(1)>span',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(3)>div:nth-child(2)>span',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(3)>div:nth-child(2)>span',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(3)>div:nth-child(3)>span',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(3)>div:nth-child(3)>span',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(3)>div:nth-child(4)>span',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(3)>div:nth-child(4)>span',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(1)>div:nth-child(2)>div>p',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'In Trattamento',
                                    'selector' => 'div#DivSmartEUS106>div:nth-child(3)>div>div:nth-child(3)>div:nth-child(2)>div>p',
                                ],
                            ]
                        ],
                    ]
                ],
            ]
        ],
    ]
];
