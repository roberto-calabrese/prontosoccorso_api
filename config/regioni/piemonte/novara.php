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
            'title' => 'Verde in attesa',
            'align' => 'end',
            'key' => 'data.data.verde.value'
        ],
        [
            'title' => 'Azzurro in attesa',
            'align' => 'end',
            'key' => 'data.data.azzurro.value'
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

return [
    'meta' => [
      'slug' => 'novara',
      'Titolo' => 'Novara'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'piemonte.novara',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'borgomaneroSsTrinita' => [
            'cache' => [
                'key' => 'piemonte.novara.borgomaneroSsTrinita',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.asl.novara.it/dea-status/ajax-callback?url=api%2FpsQueue&_=',
            'headers' => [
                'Referer' => 'https://www.asl.novara.it/',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.asl.novara.it/',
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'borgomaneroSsTrinita' => [
                    'id' => 1,
                    'nome' => 'Borgomanero - Ospedale SS.Trinità Pronto Soccorso',
                    'descrizione' => 'Ospedale SS.Trinità Pronto Soccorso - Dipartimento di Emergenza e Accettazione - DEA',
                    'adulti' => true,
                    'indirizzo' => 'Viale Zoppis, 10, 28021 Borgomanero NO',
                    'telefono' => '0322 8481',
                    'email' => '',
                    'web' => 'https://www.asl.novara.it/',
                    'google_maps' => 'https://www.google.it/maps/place/Azienda+Ospedaliera+Universitaria+San+Luigi+Gonzaga+Pronto+Soccorso/@45.0284875,7.5583361,685m/data=!3m2!1e3!4b1!4m6!3m5!1s0x478814e0d920f65f:0xbcf8c7f0d3b06c58!8m2!3d45.0284875!4d7.5583361!16s%2Fg%2F11h23jy9pt?entry=ttu&g_ep=EgoyMDI0MTIwNC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.0284875',
                        'lng' => '7.5583361',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'tr.rosso>td:nth-child(2)>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'tr.rosso>td:nth-child(2)>span',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'tr.rosso>td:nth-child(3)>span',
                                ],
                            ]
                        ],
                        'arancione' => [
                            'selector' => 'tr.arancione>td:nth-child(2)>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'tr.arancione>td:nth-child(2)>span',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'tr.arancione>td:nth-child(3)>span',
                                ],
                            ]
                        ],
                        'azzurro' => [
                            'selector' => 'tr.azzurro>td:nth-child(2)>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'tr.azzurro>td:nth-child(2)>span',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'tr.azzurro>td:nth-child(3)>span',
                                ],
                            ]
                        ],
                        'verde' => [
                            'selector' => 'tr.verde>td:nth-child(2)>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'tr.verde>td:nth-child(2)>span',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'tr.verde>td:nth-child(3)>span',
                                ],
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'tr.bianco>td:nth-child(2)>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'tr.bianco>td:nth-child(2)>span',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'tr.bianco>td:nth-child(3)>span',
                                ],
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
                                    'in_trattamento' => [
                                        'label' => 'Pazienti in trattamento',
                                        'value' => null
                                    ],
                                ]
                            ],
                        ],
                    ]
                ]
            ]
        ],
    ]
];
