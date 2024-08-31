<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

$headers = [
    'Accept' => 'application/json',
    'Accept-Language' => 'it,en-US;q=0.9,en;q=0.8,it-IT;q=0.7',
    'Cache-Control' => 'no-cache',
    'Pragma' => 'no-cache',
    'Priority' => 'u=1, i',
    'Referer' => 'https://pslive.regione.liguria.it/dettaglio/07000103',
    'Sec-CH-UA' => '"Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
    'Sec-CH-UA-Mobile' => '?0',
    'Sec-CH-UA-Platform' => '"macOS"',
    'Sec-Fetch-Dest' => 'empty',
    'Sec-Fetch-Mode' => 'cors',
    'Sec-Fetch-Site' => 'same-origin',
    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36'
];

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
        'selector' => 'prontoSoccorsoAffollamento.numAttRos',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttRos',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraRos',
            ]
        ]
    ],
    'arancione' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttAra',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttAra',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraAra',
            ]
        ]
    ],
    'azzurro' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttAzz',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttAzz',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraAzz',
            ]
        ]
    ],
    'verde' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttVer',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttVer',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraVer',
            ]
        ]
    ],
    'bianco' => [
        'selector' => 'prontoSoccorsoAffollamento.numAttBia',
        'extra' => [
            'in_attesa' => [
                'label' => 'Pazienti in attesa',
                'selector' => 'prontoSoccorsoAffollamento.numAttBia',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'prontoSoccorsoAffollamento.numTraBia',
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
                        'prontoSoccorsoAffollamento.numAttRos',
                        'prontoSoccorsoAffollamento.numAttAra',
                        'prontoSoccorsoAffollamento.numAttAzz',
                        'prontoSoccorsoAffollamento.numAttVer',
                        'prontoSoccorsoAffollamento.numAttBia',
                    ],
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in trattamento',
                    'fields' => [
                        'prontoSoccorsoAffollamento.numTraRos',
                        'prontoSoccorsoAffollamento.numTraAra',
                        'prontoSoccorsoAffollamento.numTraAzz',
                        'prontoSoccorsoAffollamento.numTraVer',
                        'prontoSoccorsoAffollamento.numTraBia',
                    ],
                ]
            ]
        ],
    ]
];

return [
    'meta' => [
      'slug' => 'genova',
      'Titolo' => 'Genova'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'liguria.genova',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'osp_evangelico' => [
            'cache' => [
                'key' => 'sicilia.liguria.genova.ops_evangelico',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07005102',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'osp_evangelico' => [
                    'id' => 1,
                    'nome' => 'Genova Voltri - Ospedale Evangelico',
                    'descrizione' => 'Ospedale Evangelico Internazionale - San Carlo Voltri',
                    'adulti' => true,
                    'indirizzo' => 'Piazzale Gianasso 4,  Genova Voltri - GE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Evangelico+Internazionale/@44.4304032,8.7456374,16z/data=!3m1!4b1!4m6!3m5!1s0x12d33c1d182189a5:0x4ab4e55e0367219b!8m2!3d44.4304032!4d8.7456374!16s%2Fg%2F1263n06h6?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 44.4300997,
                        'lng' => 8.7432917,
                    ],
                    'data' => [...$dataCommon]

                ]
            ]
        ],
        'osp_villa_scassi' => [
            'cache' => [
                'key' => 'sicilia.liguria.genova.osp_villa_scassi',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07030104',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'osp_villa_scassi' => [
                    'id' => 2,
                    'nome' => 'Genova - Ospedale Villa Scassi',
                    'descrizione' => '"Presidio Ospedaliero Metropolitano (Genova Sampierdarena) - Ospedale Villa Scassi"',
                    'adulti' => true,
                    'indirizzo' => 'Corso Onofrio Scassi, 1, 16149 Genova GE',
                    'telefono' => '010 84911',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Villa+Scassi/@44.4126525,8.8973092,16z/data=!3m1!4b1!4m6!3m5!1s0x12d3413e84731d7f:0x81817e416114c146!8m2!3d44.4126525!4d8.8973092!16s%2Fg%2F1thjq_f2?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 44.412623446951244,
                        'lng' => 8.897372340187651,
                    ],
                    'data' => [...$dataCommon]

                ]
            ]
        ],
        'osp_galliera' => [
            'cache' => [
                'key' => 'sicilia.liguria.genova.osp_galliera',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07002500',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'osp_galliera' => [
                    'id' => 3,
                    'nome' => 'Genova- E.O. Ospedali Galliera',
                    'descrizione' => 'L\'Ente ospedaliero Ospedali Galliera ("Mura delle Cappuccine") noto come ospedale Galliera - è una struttura sanitaria storica tuttora attiva. Edificato nel 1877 dalla duchessa di Galliera, è attualmente uno dei grandi complessi ospedalieri di Genova. ',
                    'adulti' => true,
                    'indirizzo' => 'Via Alessandro Volta, 6, 16128 Genova GE',
                    'telefono' => '010 56321',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/E.O.+Ospedali+Galliera+-+Genova/@44.3990373,8.9423302,16z/data=!3m1!4b1!4m6!3m5!1s0x12d343c00f4c68a5:0x188bec82278afa45!8m2!3d44.3990373!4d8.9423302!16s%2Fg%2F121v7y8y?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 44.401110500956136,
                        'lng' => 8.94046233105913,
                    ],
                    'data' => [...$dataCommon]

                ]
            ]
        ],
        'policlino_san_martino' => [
            'cache' => [
                'key' => 'sicilia.liguria.genova.policlino_san_martino',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07090100',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'policlino_san_martino' => [
                    'id' => 4,
                    'nome' => 'Genova - Policlinico San Martino',
                    'descrizione' => 'L\'Ente ospedaliero Ospedali Galliera ("Mura delle Cappuccine") noto come ospedale Galliera - è una struttura sanitaria storica tuttora attiva. Edificato nel 1877 dalla duchessa di Galliera, è attualmente uno dei grandi complessi ospedalieri di Genova. ',
                    'adulti' => true,
                    'indirizzo' => 'Via Francesco Saverio Mosso - Genova',
                    'telefono' => '010 5551',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps?hl=it&gl=it&um=1&ie=UTF-8&fb=1&sa=X&geocode=Kf0G3SZ0Q9MSMW0HhW1-IVUy&daddr=Largo+Rosanna+Benzi,+10,+16132+Genova+GE',
                    'coords' => [
                        'lat' => 44.4085485,
                        'lng' => 8.9747922,
                    ],
                    'data' => [...$dataCommon]

                ]
            ]
        ],
        'osp_gaslini_pediatrico' => [
            'cache' => [
                'key' => 'sicilia.liguria.genova.osp_gaslini_pediatrico',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07094000',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'osp_gaslini_pediatrico' => [
                    'id' => 5,
                    'nome' => 'Genova - Gaslini - Pediatrico',
                    'descrizione' => '"IST.G.Gaslini" Pediatrico Genova',
                    'adulti' => false,
                    'indirizzo' => 'Via Gerolamo Gaslini, 5, 16147 Genova GE',
                    'telefono' => '010 56361',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Istituto+Giannina+Gaslini/@44.3928372,8.9882412,16z/data=!3m1!4b1!4m6!3m5!1s0x12d34318289b6e0f:0xab3088b83b377900!8m2!3d44.3928372!4d8.9882412!16s%2Fg%2F1260_bkhl?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 44.392978698347726,
                        'lng' => 8.987861738137527,
                    ],
                    'data' => [...$dataCommon]

                ]
            ]
        ],
        'osp_del_tigullio' => [
            'cache' => [
                'key' => 'sicilia.liguria.genova.osp_del_tigullio',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07003901',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'osp_del_tigullio' => [
                    'id' => 5,
                    'nome' => 'Lavagna - Osp. Riuniti Leonardi e Riboli Lavagna',
                    'descrizione' => '"Presidio Ospedaliero ASL4 Chiavarese - Osp. Riuniti Leonardi e Riboli Lavagna"',
                    'adulti' => true,
                    'indirizzo' => 'Via Don Giovanni Battista Bobbio, 25, 16033 Lavagna GE',
                    'telefono' => '0185 3291',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place//data=!4m2!3m1!1s0x12d4a04e3ae8530b:0x8be369c0b345eb26?sa=X&ved=1t:8290&ictx=111',
                    'coords' => [
                        'lat' => 44.31497733752761,
                        'lng' => 9.34883311525914,
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ],


    ]
];
