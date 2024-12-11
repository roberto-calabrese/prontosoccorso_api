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
      'slug' => 'vercelli',
      'Titolo' => 'Vercelli'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'piemonte.vercelli',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'aslVercelli' => [
            'cache' => [
                'key' => 'piemonte.vercelli.asl',
                'ttlMinute' => 1
            ],
            'url' => 'https://psmonitor-verc.hitech-sanita.it/api/v1/ps-stats/district/1',
            'headers' => [
                'Referer' => 'https://www.aslvc.piemonte.it/54-carta-dei-servizi/21-indicazioni-pratiche-sull-azienda/come-fare-per/1513-situazione-pronto-soccorso-in-tempo-reale',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.aslvc.piemonte.it',
            ],
            'jobClass' => \App\Jobs\Piemonte\AslvcAJaxJob::class,
            'data' => [
                'vercelliAsl' => [
                    'id' => 1,
                    'nome' => 'Vercelli - Ospedale S. Andrea di Vercelli',
                    'descrizione' => 'Ospedale S. Andrea di Vercelli : Presidio Ospedaliero S. Andrea,',
                    'adulti' => true,
                    'indirizzo' => 'Corso Mario Abbiate, 21, 13100 Vercelli VC',
                    'telefono' => '0161-593111 ',
                    'email' => 'dea.vercelli@aslvc.piemonte.it',
                    'web' => 'https://www.aslvc.piemonte.it/dipartimenti-aree-e-strutture/dipartimento-area-medica/mecau-pronto-soccorso-vercelli',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+S.+Andrea+di+Vercelli+:+Presidio+Ospedaliero+S.+Andrea,/@45.3177455,8.4145497,681m/data=!3m2!1e3!4b1!4m6!3m5!1s0x47864c904981a0dd:0x619a24a7527b7a18!8m2!3d45.3177455!4d8.4145497!16s%2Fg%2F1td5w0dq?entry=ttu&g_ep=EgoyMDI0MTIwNC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.3177455',
                        'lng' => '8.4145497',
                    ],
                    'data' => [],
                ]
            ]
        ],
        'aslBorgosesia' => [
            'cache' => [
                'key' => 'piemonte.borgosesia.asl',
                'ttlMinute' => 1
            ],
            'url' => 'https://psmonitor-verc.hitech-sanita.it/api/v1/ps-stats/district/2',
            'headers' => [
                'Referer' => 'https://www.aslvc.piemonte.it/54-carta-dei-servizi/21-indicazioni-pratiche-sull-azienda/come-fare-per/1513-situazione-pronto-soccorso-in-tempo-reale',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.aslvc.piemonte.it',
            ],
            'jobClass' => \App\Jobs\Piemonte\AslvcAJaxJob::class,
            'data' => [
                'borgosesiaAsl' => [
                    'id' => 1,
                    'nome' => 'Borgosesia - Presidio Ospedaliero S.S. Pietro e Paolo',
                    'descrizione' => 'Presidio Ospedaliero S.S. Pietro e Paolo, Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Francesco Ilorini, 20, 13011 Borgosesia VC',
                    'telefono' => '0163 426111',
                    'email' => 'dea.borgosesia@aslvc.piemonte.it',
                    'web' => 'https://www.aslvc.piemonte.it/dipartimenti-aree-e-strutture/dipartimento-area-medica/pronto-soccorso-borgosesia',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedaliero+S.S.+Pietro+e+Paolo,+Pronto+Soccorso/@45.7127155,8.2614062,676m/data=!3m2!1e3!4b1!4m6!3m5!1s0x4786108cf8e06ecf:0x70289625c2a063c2!8m2!3d45.7127155!4d8.2614062!16s%2Fg%2F11fyls8qct?entry=ttu&g_ep=EgoyMDI0MTIwNC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '45.7127155',
                        'lng' => '8.2614062',
                    ],
                    'data' => [],
                ]
            ]
        ],
    ]
];
