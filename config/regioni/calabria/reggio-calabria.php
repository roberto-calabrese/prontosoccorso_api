<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

$dataCommon = [
    'rosso' => [
        'label' => 'Rosso',
        'value' => 0,
        'selector' => 'input[name="txtCodiciRossi"]',
        'extract' => 'value',
    ],
    'arancione' => [
        'label' => 'Arancione',
        'value' => 0,
        'selector' => 'input[name="txtCodiciArancioni"]',
        'extract' => 'value',
    ],
    'giallo' => [
        'label' => 'Giallo',
        'value' => 0,
        'action' => [
             'operation' => 'set_zero'
        ]
    ],
    'azzurro' => [
        'label' => 'Azzurro',
        'value' => 0,
        'selector' => 'input[name="txtCodiciAzzurri"]',
        'extract' => 'value',
    ],
    'verde' => [
        'label' => 'Verde',
        'value' => 0,
        'selector' => 'input[name="txtCodiciVerdi"]',
        'extract' => 'value',
    ],
    'bianco' => [
        'label' => 'Bianco',
        'value' => 0,
        'selector' => 'input[name="txtCodiciBianchi"]',
        'extract' => 'value',
    ],
    'totali' => [
        'label' => 'Totale in attesa',
        'value' => 0,
        'selector' => '#lblInfo2',
    ],
    'extra' => [
        'in_attesa' => [
            'label' => 'In attesa',
            'selector' => '#lblInfo2',
        ],
        'totali_entrati' => [
            'label' => 'Totale entrati',
            'selector' => '#lblInfo1',
        ],
        'casi_24h' => [
            'label' => 'Casi ultime 24h',
            'selector' => '#lblInfo4',
        ],
        'affollamento' => [
            'label' => 'Affollamento',
            'selector' => '#lblInfo3',
            'is_string' => true
        ],
        'aggiornamento' => [
            'label' => 'Aggiornamento',
            'selector' => '#lblAggiornato',
            'is_string' => true
        ]
    ]
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
            'title' => 'Giallo in attesa',
            'align' => 'end',
            'key' => 'data.data.giallo.value'
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

return [
    'meta' => [
        'slug' => 'reggio-calabria',
        'Titolo' => 'Reggio Calabria'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'calabria.reggio-calabria',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'gom' => [
            'cache' => [
                'key' => 'calabria.reggio_calabria.gom',
                'ttlMinute' => 1
            ],
            'url' => 'https://prontosoccorso.ospedalerc.it/areasMonPs/mainLogin.do?ACTION=TICKET_SSO&TICKET_PROVIDER=TK_SSO_MON&TICKET=72f2bf32-a18b-45df-b867-999bfa3383a0&URL=psweb.monitorDinamico.do?ACTION=FIND',
            'headers' => [
                'User-Agent' => $userAgent,
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'gom_reggio_calabria' => [
                    'id' => 1,
                    'nome' => 'GOM Reggio Calabria - Presidio "Riuniti"',
                    'descrizione' => 'Grande Ospedale Metropolitano "Bianchi-Melacrino-Morelli"',
                    'adulti' => true,
                    'indirizzo' => 'Via Giuseppe Melacrino, 21, 89124 Reggio Calabria RC',
                    'telefono' => '0965 397111',
                    'email' => '',
                    'web' => 'https://www.gomrc.it/',
                    'google_maps' => 'https://www.google.com/maps/place/Grande+Ospedale+Metropolitano+-+Presidio+Morelli/@38.0960592,15.6474071,17z/data=!3m1!4b1!4m6!3m5!1s0x131450820a49ce6d:0x3eaf2900c8acaf41!8m2!3d38.0960592!4d15.6474071!16s%2Fg%2F1260mrghz?hl=it&entry=ttu&g_ep=EgoyMDI1MTIwOS4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.0960592',
                        'lng' => '15.6474071',
                    ],
                    'data' => $dataCommon,
                ]
            ]
        ]
    ]
];
