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
      'slug' => 'imperia',
      'Titolo' => 'Imperia'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'liguria.imperia',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'bordighera' => [
            'cache' => [
                'key' => 'liguria.imperia.bordighera',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07000103',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'saint_charles' => [
                    'id' => 1,
                    'nome' => 'Bordighera - Saint Charles',
                    'descrizione' => 'Presidio Ospedaliero Unificato - Stabilimento Ospedaliero di Bordighera - Struttura dedicata a patologie e prestazioni di bassa complessità',
                    'adulti' => true,
                    'indirizzo' => 'Via Aurelia 122 - Bordighera - IM',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps?sca_esv=9e19fdb118b43033&sxsrf=ADLYWIIxDBk8dM0VgK8BReVoPGkEWu0_aw:1725117327261&iflsig=AL9hbdgAAAAAZtNBn__srNa0BD19Hv4BmkaQu-GIbde1&uact=5&gs_lp=Egdnd3Mtd2l6IjdPc3BlZGFsZSBFdmFuZ2VsaWNvIEludGVybmF6aW9uYWxlIC0gU2FuIENhcmxvIFZvbHRyaQoKMg0QLhjRAxjHARgnGOoCMgcQIxgnGOoCMgcQIxgnGOoCMgcQLhgnGOoCMgcQIxgnGOoCMgcQIxgnGOoCMgcQLhgnGOoCMgcQIxgnGOoCMgcQIxgnGOoCMgcQIxgnGOoCSOoCULkBWLkBcAF4AJABAJgBAKABAKoBALgBA8gBAPgBAvgBAZgCAaACB6gCCpgDB5IHATGgBwA&um=1&ie=UTF-8&fb=1&gl=it&sa=X&geocode=KaWJIRgdPNMSMZshZwNe5bRK&daddr=P.le+Efisio+Gianasso,+4,+16158+Genova+GE',
                    'coords' => [
                        'lat' => '43.78476426198199',
                        'lng' => '7.648010647783196',
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ],
        'imperia_santagata' => [
            'cache' => [
                'key' => 'liguria.imperia.santagata',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07000101',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'santagata' => [
                    'id' => 1,
                    'nome' => 'Imperia - Sant\'Agata',
                    'descrizione' => 'Presidio Ospedaliero Unificato - Stabilimento Ospedaliero di Imperia',
                    'adulti' => true,
                    'indirizzo' => 'Sant\'Agata 57 - Imperia - IM',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Imperia/@43.8916768,8.0277196,17z/data=!3m1!4b1!4m6!3m5!1s0x12d26ea7173d4a27:0xbf8ed12e5e8b9c07!8m2!3d43.891673!4d8.0302945!16s%2Fg%2F12605dg_l?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 43.89146010958014,
                        'lng' => 8.030312852818343,
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ],
        'sanremo_borea' => [
            'cache' => [
                'key' => 'liguria.imperia.sanremo_borea',
                'ttlMinute' => 1
            ],
            'url' => 'https://pslive.regione.liguria.it/api/prontosoccorso/07000102',
            'method' => 'GET',
            'headers' => $headers,
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'sanremo_borea' => [
                    'id' => 1,
                    'nome' => 'Sanremo - Giovanni Borea',
                    'descrizione' => 'Presidio Ospedaliero Unificato - Stabilimento Ospedaliero di Sanremo',
                    'adulti' => true,
                    'indirizzo' => 'Via Giovanni Borea 56 - Sanremo - IM',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://pslive.regione.liguria.it/dashboard',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+di+Sanremo/@43.8226922,7.7793986,16z/data=!3m1!4b1!4m6!3m5!1s0x12cdf550c84d6947:0xf2de780a6eb017cb!8m2!3d43.8226922!4d7.7793986!16s%2Fg%2F1264pq_zs?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => 43.822223641864255,
                        'lng' => 7.779106107638991,
                    ],
                    'data' => [...$dataCommon]
                ]
            ]
        ]
    ]
];
