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

// L'API dell'ASL TO5 restituisce tutti i presidi in un'unica risposta:
// dopo le transformations ogni presidio e' raggiungibile con 'ospedali.<id>'
// e i codici colore con 'triage.<nome>'.
$aslTo5Colori = [
    'rosso' => 'Rosso',
    'arancione' => 'Arancio',
    'azzurro' => 'Azzurro',
    'verde' => 'Verde',
    'bianco' => 'Bianco',
];

$buildAslTo5Data = static function (int $idPresidio) use ($aslTo5Colori): array {

    $campiColore = static fn(string $campo): array => array_map(
        static fn(string $triage): string => "ospedali.$idPresidio.triage.$triage.$campo",
        array_values($aslTo5Colori)
    );

    $data = [];

    foreach ($aslTo5Colori as $colore => $triage) {
        $base = "ospedali.$idPresidio.triage.$triage";

        $data[$colore] = [
            'selector' => "$base.in_attesa",
            'default' => 0,
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'selector' => "$base.in_attesa",
                    'default' => 0,
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'selector' => "$base.in_cura",
                    'default' => 0,
                ],
                'totale_presenti' => [
                    'label' => 'Totale presenti',
                    'selector' => "$base.totale",
                    'default' => 0,
                ],
            ]
        ];
    }

    $data['totali'] = [
        'action' => [
            'operation' => 'sum',
            'keys' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'fields' => $campiColore('in_attesa'),
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'fields' => $campiColore('in_cura'),
                ],
                'totale_presenti' => [
                    'label' => 'Totale presenti',
                    'fields' => $campiColore('totale'),
                ],
            ]
        ],
    ];

    $data['extra'] = [
        'pazienti_presenti' => [
            'label' => 'Pazienti presenti',
            'selector' => "ospedali.$idPresidio.pazienti_presenti",
            'default' => 0,
        ],
        'ambulanze_in_arrivo' => [
            'label' => 'Ambulanze in arrivo',
            'selector' => "ospedali.$idPresidio.ambulanze_in_arrivo",
            'default' => 0,
        ],
        // L'API pubblica l'orario in UTC senza indicare il fuso.
        'ultimo_aggiornamento' => [
            'label' => 'Ultimo aggiornamento',
            'selector' => 'timestamp',
            'format' => 'utc_to_local',
        ],
    ];

    return $data;
};

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
                    'id' => 2,
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
                    'id' => 3,
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
                    'id' => 4,
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
                'regina_margherita' => [
                    'id' => 5,
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
        'torinoMauriziano' => [
            'cache' => [
                'key' => 'piemonte.torino.mauriziano',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.mauriziano.it/i-nostri-servizi/pazienti-in-attesa-presso-pronto-soccorso',
            'headers' => [
                'Referer' => 'https://www.mauriziano.it/',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.mauriziano.it/'
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'mauriziano' => [
                    'id' => 6,
                    'nome' => 'Torino - Ospedale Mauriziano Umberto Pronto Soccorso',
                    'descrizione' => 'Ospedale Mauriziano Umberto I',
                    'adulti' => true,
                    'indirizzo' => ' Corso Carlo e Nello Rosselli, 2, 10128 Torino TO',
                    'telefono' => '011 508 2370',
                    'email' => '',
                    'web' => 'https://www.mauriziano.it/i-nostri-servizi/pazienti-in-attesa-presso-pronto-soccorso',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Mauriziano+Umberto+Pronto+Soccorso/@45.050979,7.6651525,1369m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47886d374ab5dfef:0xbe88fc05f4c1c061!8m2!3d45.050979!4d7.6651525!16s%2Fg%2F11c1gbrzzw?entry=ttu&g_ep=EgoyMDI0MTIwOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.050979',
                        'lng' => '7.6651525',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(1)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                            ]
                        ],
                        'arancione' => [
                            'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(2)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                            ]
                        ],
                        'azzurro' => [
                            'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(3)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(3)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ],
                            ]
                        ],
                        'verde' => [
                            'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(4)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(4)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(4)>td:nth-child(3)',
                                ],
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(5)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(5)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'table#TableTempiAttesaProntoSoccorso>tbody>tr:nth-child(5)>td:nth-child(3)',
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
        // Un'unica chiamata restituisce tutte le strutture dell'ASL Citta' di Torino:
        // gli ospedali vengono abbinati tramite il campo 'codice'.
        'aslCittaDiTorino' => [
            'cache' => [
                'key' => 'piemonte.torino.aslCittaDiTorino',
                'ttlMinute' => 1
            ],
            'url' => 'https://prontosoccorso.aslcittaditorino.it/api/strutture/',
            'auth' => [
                'url' => 'https://prontosoccorso.aslcittaditorino.it/oauth/token',
                'clientId' => env('ASL_TORINO_CLIENT_ID', 'jhisps'),
                'clientSecret' => env('ASL_TORINO_CLIENT_SECRET', 'Sincos38'),
                'username' => env('ASL_TORINO_USERNAME', 'aziendaact'),
                'password' => env('ASL_TORINO_PASSWORD', 'jh!sPsClient'),
            ],
            'headers' => [
                'Accept' => 'application/json, text/plain, */*',
                'Referer' => 'https://prontosoccorso.aslcittaditorino.it/situazione',
                'User-Agent' => $userAgent,
                'Origin' => 'https://prontosoccorso.aslcittaditorino.it',
            ],
            'jobClass' => \App\Jobs\Piemonte\AslCittaDiTorinoAJaxJob::class,
            'data' => [
                'maria_vittoria' => [
                    'id' => 7,
                    'codice' => '01000300',
                    'nome' => 'Torino - Ospedale Maria Vittoria',
                    'descrizione' => 'Ospedale Maria Vittoria - Amedeo di Savoia, uno dei cinque ospedali generali di riferimento per l\'area metropolitana di Torino. ASL Citta\' di Torino.',
                    'adulti' => true,
                    'indirizzo' => 'Via Cibrario, 72, 10144 Torino TO',
                    'telefono' => '011 439 3111',
                    'email' => '',
                    'web' => 'https://www.aslcittaditorino.it/strutture_sanitarie/ospedale-maria-vittoria/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.08192719084199,7.656632793872947',
                    'coords' => [
                        'lat' => '45.08192719084199',
                        'lng' => '7.656632793872947',
                    ],
                    'data' => []
                ],
                'martini' => [
                    'id' => 8,
                    'codice' => '01000700',
                    'nome' => 'Torino - Ospedale Martini',
                    'descrizione' => 'Ospedale Martini, presidio ospedaliero dell\'ASL Citta\' di Torino organizzato su base dipartimentale.',
                    'adulti' => true,
                    'indirizzo' => 'Via Tofane, 71, 10141 Torino TO',
                    'telefono' => '011 709 5111',
                    'email' => '',
                    'web' => 'https://www.aslcittaditorino.it/strutture_sanitarie/ospedale-martini/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.067090062881256,7.6285316846410405',
                    'coords' => [
                        'lat' => '45.067090062881256',
                        'lng' => '7.6285316846410405',
                    ],
                    'data' => []
                ],
                'oftalmico' => [
                    'id' => 9,
                    'codice' => '01001000',
                    'nome' => 'Torino - Ospedale Oftalmico',
                    'descrizione' => 'Ospedale Oftalmico, centro regionale per l\'emergenza oculistica. Pronto soccorso oculistico attivo dal lunedi\' al venerdi\' 8:00-22:00, sabato, domenica e festivi 8:00-20:00. Fuori orario ci si rivolge al pronto soccorso dell\'Ospedale Maria Vittoria.',
                    'adulti' => true,
                    'indirizzo' => 'Via Filippo Juvarra, 19, 10122 Torino TO',
                    'telefono' => '011 566 1566',
                    'email' => '',
                    'web' => 'https://www.aslcittaditorino.it/strutture_sanitarie/ospedale-oftalmico/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.07456241948964,7.670830683465644',
                    'coords' => [
                        'lat' => '45.07456241948964',
                        'lng' => '7.670830683465644',
                    ],
                    'data' => []
                ],
                'san_giovanni_bosco' => [
                    'id' => 10,
                    'codice' => '01001100',
                    'nome' => 'Torino - Ospedale San Giovanni Bosco',
                    'descrizione' => 'Ospedale San Giovanni Bosco, il piu\' grande ospedale della zona Nord di Torino. ASL Citta\' di Torino.',
                    'adulti' => true,
                    'indirizzo' => 'Piazza del Donatore di Sangue, 3, 10154 Torino TO',
                    'telefono' => '011 240 1111',
                    'email' => '',
                    'web' => 'https://www.aslcittaditorino.it/strutture_sanitarie/ospedale-giovanni-bosco/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.0977660899632,7.700378179361587',
                    'coords' => [
                        'lat' => '45.0977660899632',
                        'lng' => '7.700378179361587',
                    ],
                    'data' => []
                ],
            ]
        ],
        // Un'unica chiamata restituisce i tre presidi dell'ASL TO5
        // (Chieri, Moncalieri, Carmagnola): gli ospedali vengono abbinati
        // tramite l'id presente nella risposta.
        'aslTo5' => [
            'cache' => [
                'key' => 'piemonte.torino.aslTo5',
                'ttlMinute' => 1
            ],
            'url' => 'https://servizi.aslto5.piemonte.it/ps/api/dati',
            'headers' => [
                'Accept' => 'application/json, text/plain, */*',
                'Referer' => 'https://servizi.aslto5.piemonte.it/ps/',
                'User-Agent' => $userAgent,
                'Origin' => 'https://servizi.aslto5.piemonte.it',
            ],
            'transformations' => [
                'path_key_by' => [
                    'ospedali' => 'id',
                    'ospedali.*.triage' => 'nome',
                ]
            ],
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'chieri' => [
                    'id' => 11,
                    'nome' => 'Chieri - Ospedale Maggiore',
                    'descrizione' => 'Ospedale Maggiore di Chieri, sede di DEA di I livello dell\'ASL TO5.',
                    'adulti' => true,
                    'indirizzo' => 'Via Giovanni De Maria, 1, 10023 Chieri TO',
                    'telefono' => '011 94291',
                    'email' => 'dirsan.riuniti@aslto5.piemonte.it',
                    'web' => 'https://www.aslto5.piemonte.it/it/sede/ospedale-maggiore',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.0106285,7.8236629',
                    'coords' => [
                        'lat' => '45.0106285',
                        'lng' => '7.8236629',
                    ],
                    'data' => $buildAslTo5Data(1)
                ],
                'moncalieri' => [
                    'id' => 12,
                    'nome' => 'Moncalieri - Ospedale Santa Croce',
                    'descrizione' => 'Ospedale Santa Croce di Moncalieri, sede di DEA di I livello dell\'ASL TO5. L\'ingresso del pronto soccorso, pedonale e per le ambulanze, e\' in Via Galileo Galilei.',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Augusto Ferdinando, 3, 10024 Moncalieri TO',
                    'telefono' => '011 69301',
                    'email' => 'dirsan.riuniti@aslto5.piemonte.it',
                    'web' => 'https://www.aslto5.piemonte.it/it/sede/ospedale-santa-croce',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=45.0018347,7.6899411',
                    'coords' => [
                        'lat' => '45.0018347',
                        'lng' => '7.6899411',
                    ],
                    'data' => $buildAslTo5Data(2)
                ],
                'carmagnola' => [
                    'id' => 13,
                    'nome' => 'Carmagnola - Ospedale San Lorenzo',
                    'descrizione' => 'Ospedale San Lorenzo di Carmagnola, sede di pronto soccorso dell\'ASL TO5.',
                    'adulti' => true,
                    'indirizzo' => 'Via Ospedale, 13, 10022 Carmagnola TO',
                    'telefono' => '011 97191',
                    'email' => 'dirsan.riuniti@aslto5.piemonte.it',
                    'web' => 'https://www.aslto5.piemonte.it/it/sede/ospedale-san-lorenzo',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=44.8468055,7.7165660',
                    'coords' => [
                        'lat' => '44.8468055',
                        'lng' => '7.7165660',
                    ],
                    'data' => $buildAslTo5Data(3)
                ],
            ]
        ],
    ]
];
