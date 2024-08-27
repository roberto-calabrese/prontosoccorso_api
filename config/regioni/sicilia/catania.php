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
                    'indirizzo' => 'Via S. Sofia, 78, 95123 Catania CT',
                    'telefono' => '095 479 4111',
                    'email' => '',
                    'web' => 'https://policlinicorodolicosanmarco.it/',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+Gaspare+Rodolico/@37.529246,15.0693695,17z/data=!3m1!4b1!4m6!3m5!1s0x1313fd34dc489d2f:0x331cee779e74911!8m2!3d37.529246!4d15.0693695!16s%2Fg%2F11fmz3jp99?entry=ttu',
                    'coords' => [
                        'lat' => '37.529246',
                        'lng' => '15.0693695',
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
                    'indirizzo' => 'Viale Carlo Azeglio Ciampi, 95121 Catania CT',
                    'telefono' => '0954794111',
                    'email' => '',
                    'web' => 'https://policlinicorodolicosanmarco.it/',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+San+Marco/@37.4798414,15.0363461,17z/data=!3m1!4b1!4m6!3m5!1s0x1313e3b279f913c7:0xf01e65244b688428!8m2!3d37.4798414!4d15.0363461!16s%2Fg%2F11fhn0xc8z?hl=it&entry=ttu',
                    'coords' => [
                        'lat' => '37.4798414',
                        'lng' => '15.0363461',
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
