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

$dataCommons = [
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
                'in_osservazione' => [
                    'label' => 'Pazienti in osservazione',
                    'value' => null
                ],

            ]
        ],
    ]
];

return [
    'meta' => [
      'slug' => 'siracusa',
      'Titolo' => 'Siracusa',
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'sicilia.siracusa',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'pso_siracusa' => [
            'cache' => [
                'key' => 'sicilia.palermo.pso_siracusa',
                'ttlMinute' => 1
            ],
            'url' => 'https://cod.asp.sr.it/monitoringps/',
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'pso_umbero1' => [
                    'id' => 1,
                    'nome' => 'Siracusa - Umberto I',
                    'descrizione' => '',
                    'adulti' => true,
                    'indirizzo' => 'Via Giuseppe Testaferrata, 1, 96100 Siracusa SR',
                    'telefono' => '095 479 4111',
                    'degenza' => '6 posti letto',
                    'email' => '',
                    'web' => 'https://www.asp.sr.it/Azienda/Strutture-Organizzative/Pronto-Soccorso-Umberto-I',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Umberto+I/@37.0734429,15.2827194,16z/data=!3m1!4b1!4m6!3m5!1s0x1313ce9bcdfd6da7:0xdd0ae0a2615d945f!8m2!3d37.0734429!4d15.2827194!16s%2Fg%2F1tpx1zhh?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '37.0734429',
                        'lng' => '15.2827194',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_Umberto_I_Siracusa>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_Umberto_I_Siracusa>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(3)'
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_Umberto_I_Siracusa>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_Umberto_I_Siracusa>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_Umberto_I_Siracusa>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_Umberto_I_Siracusa>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(4)',
                                ]

                            ]
                        ],
                        'bianco' => [
                            'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_Umberto_I_Siracusa>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_Umberto_I_Siracusa>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'totali' => [...$dataCommons['totali']]
                    ]
                ],
                'pso_augusta' => [
                    'id' => 2,
                    'nome' => 'Augusta - E.Muscatello',
                    'descrizione' => 'Ospedale E.Muscatello - Augusta',
                    'adulti' => true,
                    'indirizzo' => 'C/da Granatello, 96011 Augusta SR',
                    'telefono' => '0931989065',
                    'email' => '',
                    'web' => 'https://www.asp.sr.it/Azienda/Strutture-Organizzative/Pronto-Soccorso-Augusta',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+E.Muscatello+-+Pronto+Soccorso/@37.2459047,15.2354756,17z/data=!4m14!1m7!3m6!1s0x1313c35bd08cd04d:0x295f687fef714256!2sOspedale+E.Muscatello+-+Augusta!8m2!3d37.2459047!4d15.2354756!16s%2Fg%2F12602tgrp!3m5!1s0x1313c35bd08cd04d:0x6e8e4fb8ca493f56!8m2!3d37.2458384!4d15.2347504!16s%2Fg%2F11fylv_cvg?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '37.2459047',
                        'lng' => '15.2354756',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_AUGUSTA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_AUGUSTA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(1)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_AUGUSTA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_AUGUSTA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(2)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_AUGUSTA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_AUGUSTA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(3)>td:nth-child(4)',
                                ]
                        ]
                            ],
                        'bianco' => [
                            'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_AUGUSTA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_AUGUSTA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(3)>div:nth-child(2)>div>table>tbody>tr:nth-child(4)>td:nth-child(4)',
                                ]
                            ],
                        ],
                        'totali' => [...$dataCommons['totali']]
                    ]

                ],
                'pso_noto' => [
                    'id' => 3,
                    'nome' => 'Noto - G. Trigona',
                    'descrizione' => 'Ospedale Unico- Avola-Noto Presidio "G. Trigona" - Noto',
                    'adulti' => true,
                    'indirizzo' => 'Via dei Mille, 98, 96017 Noto SR',
                    'telefono' => '0931 890111',
                    'email' => '',
                    'web' => 'https://www.asp.sr.it/Azienda/Strutture-Organizzative/Pronto-Soccorso-Noto',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Unico-+Avola-Noto+Presidio+%22G.+Trigona%22+-+Noto/@36.9040288,15.069256,17z/data=!3m1!4b1!4m6!3m5!1s0x131229a28d7618e9:0x58f03ad66468f8ac!8m2!3d36.9040288!4d15.069256!16s%2Fg%2F1tfz72y0?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '36.9040288',
                        'lng' => '15.069256',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_NOTO>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_NOTO>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_NOTO>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_NOTO>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_NOTO>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_NOTO>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_NOTO>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_NOTO>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(4)',
                                ]
                            ],
                        ],
                        'totali' => [...$dataCommons['totali']]
                    ]

                ],
                'pso_avola' => [
                    'id' => 4,
                    'nome' => 'Avola - G. di Maria',
                    'descrizione' => 'Ospedale G. di Maria',
                    'adulti' => true,
                    'indirizzo' => 'SS115 Contrada Chiusa di Carlo, 96012 Avola SR',
                    'telefono' => '0931 582111',
                    'email' => '',
                    'web' => 'https://www.asp.sr.it/Azienda/Strutture-Organizzative/Pronto-Soccorso-Avola',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+G.+di+Maria+Pronto+Soccorso/@36.925491,15.1588217,17z/data=!3m1!4b1!4m6!3m5!1s0x13122c3ace1b1093:0x63107beb0effd0d1!8m2!3d36.925491!4d15.1588217!16s%2Fg%2F11gcqx4hk2?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '36.925491',
                        'lng' => '15.1588217',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_AVOLA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_AVOLA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(1)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_AVOLA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_AVOLA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(2)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_AVOLA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_AVOLA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(3)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_AVOLA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_AVOLA>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(4)>div:nth-child(2)>div>table>tbody>tr:nth-child(4)>td:nth-child(4)',
                                ]
                            ],
                        ],
                        'totali' => [...$dataCommons['totali']]
                    ]

                ],
                'pso_lentini' => [
                    'id' => 5,
                    'nome' => 'Lentini - Ospedale di Lentini ',
                    'descrizione' => 'Ospedale di Lentini :Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'SS194, 96016 Lentini SR',
                    'telefono' => '095 909533',
                    'email' => '',
                    'web' => 'https://www.asp.sr.it/Azienda/Strutture-Organizzative/Pronto-Soccorso-Lentini',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Lentini+:Pronto+Soccorso/@37.284467,14.9828598,17z/data=!3m1!4b1!4m6!3m5!1s0x131161779e596ed9:0x1455fbca3b991d23!8m2!3d37.284467!4d14.9828598!16s%2Fg%2F11fylslv9m?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '37.284467',
                        'lng' => '14.9828598',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_Lentini>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_Lentini>div>div>div:nth-child(2)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(1)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_Lentini>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_Lentini>div>div>div:nth-child(2)>table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(2)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_Lentini>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_Lentini>div>div>div:nth-child(2)>table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(3)>td:nth-child(4)',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'Pazienti in osservazione',
                                    'selector' => 'div#modalPSO_-_Lentini>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'dimessi_24h' => [
                                    'label' => 'Pazienti dimessi 24h',
                                    'selector' => 'div#modalPSO_-_Lentini>div>div>div:nth-child(2)>table>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                                'attesa_media' => [
                                    'label' => 'Attesa Media',
                                    'is_string' => true,
                                    'selector' => 'div.col-sm>div:nth-child(5)>div:nth-child(1)>div>table>tbody>tr:nth-child(4)>td:nth-child(4)',
                                ]
                            ],
                        ],
                        'totali' => [...$dataCommons['totali']]
                    ]

                ],
            ]
        ],
    ]
];
