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
      'slug' => 'torino',
      'Titolo' => 'Torino'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'piemonte.torino',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'orbassanoSanLuigiGonzaga' => [
            'cache' => [
                'key' => 'piemonte.torino.sanLuigiGonzaga',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.sanluigi.piemonte.it/dea-status/ajax-callback?url=api%2FdeaStatus&_=',
            'headers' => [
                'Referer' => 'https://www.sanluigi.piemonte.it/scheda-informativa/pronto-soccorso',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.sanluigi.piemonte.it/',
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'sanLuigiGonzaga' => [
                    'id' => 1,
                    'nome' => 'Orbassano - Azienda Ospedaliera Universitaria San Luigi Gonzaga Pronto',
                    'descrizione' => 'Azienda Ospedaliera Universitaria San Luigi Gonzaga Pronto',
                    'adulti' => true,
                    'indirizzo' => 'Regione Gonzole, 10, 10043 Orbassano TO',
                    'telefono' => '011 902 6735',
                    'email' => 'urp@sanluigi.piemonte.it',
                    'web' => 'https://www.sanluigi.piemonte.it/scheda-informativa/pronto-soccorso',
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
        'torinoMolinette' => [
            'cache' => [
                'key' => 'piemonte.torino.molinette',
                'ttlMinute' => 1
            ],
            'url' => 'https://listeps.cittadellasalute.to.it/gtotal.php?id=01090101',
            'headers' => [
                'Referer' => 'https://www.cittadellasalute.to.it/index.php?option=com_content&view=article&id=6786:situazione-pazienti-in-pronto-soccorso&catid=165:pronto-soccorso&Itemid=372',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.cittadellasalute.to.it'
            ],
            'jobClass' => \App\Jobs\Piemonte\CittaDellaSaluteAJaxJob::class,
            'data' => [
                'molinette' => [
                    'id' => 1,
                    'nome' => 'Torino - Pronto Soccorso Molinette',
                    'descrizione' => 'Azienda Ospedaliero-Universitaria Città della Salute e della Scienza di Torino',
                    'adulti' => true,
                    'indirizzo' => 'Corso Bramante, 88, 10126 Torino TO',
                    'telefono' => ' 011 633 1633',
                    'email' => '',
                    'web' => 'https://www.cittadellasalute.to.it/index.php?option=com_content&view=article&id=6053:pronto-soccorso-molinette&catid=165:pronto-soccorso&Itemid=372',
                    'google_maps' => 'https://www.google.it/maps/place/Pronto+Soccorso+Molinette/@45.041608,7.6741324,1369m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47886d4b56b65bcb:0x66e682a098de374!8m2!3d45.041608!4d7.6741324!16s%2Fg%2F11bwqmpdlt?entry=ttu&g_ep=EgoyMDI0MTIwNC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.041608',
                        'lng' => '7.6741324',
                    ],
                    'data' => []
                ]
            ]
        ],
        'torinoCto' => [
            'cache' => [
                'key' => 'piemonte.torino.cto',
                'ttlMinute' => 1
            ],
            'url' => 'https://listeps.cittadellasalute.to.it/gtotal.php?id=01090201',
            'headers' => [
                'Referer' => 'https://www.cittadellasalute.to.it/index.php?option=com_content&view=article&id=6786:situazione-pazienti-in-pronto-soccorso&catid=165:pronto-soccorso&Itemid=372',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.cittadellasalute.to.it'
            ],
            'jobClass' => \App\Jobs\Piemonte\CittaDellaSaluteAJaxJob::class,
            'data' => [
                'cto' => [
                    'id' => 2,
                    'nome' => 'Torino - Presidio Ospedaliero CTO Pronto Soccorso',
                    'descrizione' => 'C.T.O. Centro Traumatologico Ortopedico',
                    'adulti' => true,
                    'indirizzo' => 'Via Gianfranco Zuretti, 29, 10126 Torino TO',
                    'telefono' => '011 633 1633',
                    'email' => 'dirmedcto@cittadellasalute.to.it.',
                    'web' => 'https://www.cittadellasalute.to.it/index.php?option=com_content&view=article&id=6053:pronto-soccorso-molinette&catid=165:pronto-soccorso&Itemid=372',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+CTO+Pronto+Soccorso/@45.0338168,7.6739643,1369m/data=!3m2!1e3!4b1!4m6!3m5!1s0x478812b0e44803d7:0x21c391e04084e709!8m2!3d45.0338168!4d7.6739643!16s%2Fg%2F11c1vk4l6h?entry=ttu&g_ep=EgoyMDI0MTIwOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.0338168',
                        'lng' => '7.6739643',
                    ],
                    'data' => []
                ]
            ]
        ],
        'torinoStAnna' => [
            'cache' => [
                'key' => 'piemonte.torino.stanna',
                'ttlMinute' => 1
            ],
            'url' => 'https://listeps.cittadellasalute.to.it/gtotal.php?id=01090301',
            'headers' => [
                'Referer' => 'https://www.cittadellasalute.to.it/index.php?option=com_content&view=article&id=6786:situazione-pazienti-in-pronto-soccorso&catid=165:pronto-soccorso&Itemid=372',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.cittadellasalute.to.it'
            ],
            'jobClass' => \App\Jobs\Piemonte\CittaDellaSaluteAJaxJob::class,
            'data' => [
                'st_anna' => [
                    'id' => 2,
                    'nome' => 'Torino - Ospedale Sant\'anna',
                    'descrizione' => 'Ospedale Ostetrico Ginecologico Sant\'Anna',
                    'adulti' => true,
                    'indirizzo' => 'Via Ventimiglia, 3, 10126 Torino TO',
                    'telefono' => '011 633 1633',
                    'email' => '',
                    'web' => 'https://www.cittadellasalute.to.it/index.php?option=com_content&view=article&id=6053:pronto-soccorso-molinette&catid=165:pronto-soccorso&Itemid=372',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Sant\'anna/@45.0356386,7.6730952,1369m/data=!3m2!1e3!4b1!4m6!3m5!1s0x478812b125c72ca7:0xbc6b5e75691755a9!8m2!3d45.0356386!4d7.6730952!16s%2Fg%2F11h0zd5n6r?entry=ttu&g_ep=EgoyMDI0MTIwOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.0356386',
                        'lng' => '7.6730952',
                    ],
                    'data' => []
                ]
            ]
        ],
        'torinoReginaMargherita' => [
            'cache' => [
                'key' => 'piemonte.torino.reginaMargherita',
                'ttlMinute' => 1
            ],
            'url' => 'https://listeps.cittadellasalute.to.it/gtotal.php?id=01090302',
            'headers' => [
                'Referer' => 'https://www.cittadellasalute.to.it/index.php?option=com_content&view=article&id=6786:situazione-pazienti-in-pronto-soccorso&catid=165:pronto-soccorso&Itemid=372',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.cittadellasalute.to.it'
            ],
            'jobClass' => \App\Jobs\Piemonte\CittaDellaSaluteAJaxJob::class,
            'data' => [
                'st_anna' => [
                    'id' => 10,
                    'nome' => 'Torino - Ospedale Regina Margherita',
                    'descrizione' => 'L\'ospedale infantile Regina Margherita di Torino, con l\'ospedale ostetrico-ginecologico Sant\'Anna, costituisce un presidio ospedaliero di rilievo nazionale ad alta specializzazione materno-infantile. Fa parte dell\'AOU Città della Salute e della Scienza.',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Polonia, 94, 10126 Torino TO',
                    'telefono' => '011 633 1633',
                    'email' => '',
                    'web' => 'https://www.cittadellasalute.to.it/index.php?option=com_content&view=article&id=6053:pronto-soccorso-molinette&catid=165:pronto-soccorso&Itemid=372',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Regina+Margherita/@45.0345744,7.6747616,1369m/data=!3m2!1e3!4b1!4m6!3m5!1s0x478812b1767bd491:0x1eb78d46255ef6ef!8m2!3d45.0345744!4d7.6747616!16s%2Fg%2F120ldkrg?entry=ttu&g_ep=EgoyMDI0MTIwOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.0345744',
                        'lng' => '7.6747616',
                    ],
                    'data' => []
                ]
            ]
        ],
    ]
];
