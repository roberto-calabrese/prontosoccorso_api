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

$dataCommons = [
    'rosso' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(2)',
    ],
    'arancione' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(3)',
    ],
    'giallo' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(4)',
    ],
    'verde' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(5)',
    ],
    'azzurro' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(6)',
    ],
    'bianco' => [
        'selector' => 'table.table>tbody>tr:nth-child($I)>td:nth-child(7)',
    ],
    'totali' => [
        'action' => [
            'operation' => 'sum',
            'keys' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'value' => null
                ]
            ]
        ],
    ]
];

return [
    'meta' => [
      'slug' => 'agrigento',
      'Titolo' => 'Agrigento'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'sicilia.agrigento',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'aspAgrigento' => [
            'cache' => [
                'key' => 'sicilia.agrigento.aspAgrigento',
                'ttlMinute' => 1
            ],
            'url' => 'http://pswall.aspag.it/ps/listaattesa.php',
            'headers' => [
                'Referer' => 'http://www.aspag.it/',
                'User-Agent' => $userAgent,
                'Origin' => 'http://www.aspag.it/',
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'iterateSelector' => '$I',
            'data' => [
                'ps_agrigento' => [
                    'id' => 1,
                    'nome' => 'Agrigento - Ospedale San Giovanni di Dio',
                    'descrizione' => 'La Unità Operativa è così articolata: PRONTO SOCCORSO eroga prestazioni sanitarie per la diagnosi e il trattamento di patologie a carattere di emergenza / urgenza; OSSERVAZIONE BREVE eroga prestazioni sanitarie finalizzate alla stabilizzazione del paziente e alla verifica della appropriatezza diagnostica orientate alla eventuale ospedalizzazione o dimissione del paziente; MEDICINA D’URGENZA eroga prestazioni sanitarie assimilabili a quelle di ricovero ordinario di pazienti con patologia medica (12 posti letto). L\'Unità Operativa è allocata al 1° piano dell’Ospedale con accesso dalla scala B; raggiungibile anche dall\’esterno seguendo le indicazioni stradali presenti nell’area esterna periospedaliera.',
                    'adulti' => true,
                    'indirizzo' => 'Contrada Consolida, 92100 Agrigento AG',
                    'telefono' => '0922 442111',
                    'email' => ' poagrigento.prontosoccorso@aspag.it',
                    'web' => 'http://www.aspag.it/index.php/monitoraggio-in-tempo-reale',
                    'google_maps' => 'https://www.google.it/maps/place/PRONTO+SOCCORSO+%22SAN+GIOVANNI+DI+DIO%22/@37.3520998,13.6077597,16.99z/data=!4m6!3m5!1s0x13108336b1e14fbb:0x2631d0174c2f5c65!8m2!3d37.352122!4d13.607766!16s%2Fg%2F11fylstvgt?entry=ttu',
                    'coords' => [
                        'lat' => '37.3520998',
                        'lng' => '13.6077597',
                    ],
                    'data' => $dataCommons,
                ],
                'ps_canicatti' => [
                    'id' => 2,
                    'nome' => 'Canicattì - Ospedale Barone Lombardo',
                    'descrizione' => 'Ospedale Canicattì - Il Pronto soccorso si trova al Piano 0 ed è aperto 24h da Lunedì a Domenica.',
                    'adulti' => true,
                    'indirizzo' => 'Contrada Giarre, 92024 Canicattì AG',
                    'telefono' => '0922 733111',
                    'email' => 'pocanicatti.prontosoccorso@aspag.it',
                    'web' => 'http://www.aspag.it/index.php/monitoraggio-in-tempo-reale',
                    'google_maps' => 'https://www.google.it/maps/place//data=!4m2!3m1!1s0x1310924686e619c7:0x23b2c9ed266306fa?sa=X&ved=1t:8290&ictx=111',
                    'coords' => [
                        'lat' => '37.3526077',
                        'lng' => '13.8342088',
                    ],
                    'data' => $dataCommons,
                ],
                'ps_licata' => [
                    'id' => 3,
                    'nome' => 'Licata - Ospedale San Giacomo d\'Altopasso',
                    'descrizione' => 'Prestazioni assicurate Triage principali prestazioni Visite, emergenze e urgenze Stabilizzazione Osservazione breve del Paziente Branche specialistiche: Traumatologia, Cardiologia, Medicina, Psichiatria, Pediatria, Chirurgia, Chirurgia vascolare, ORL Dal 1 gennaio 2010, 4 posti letto consentono le attività di stabilizzazione del paziente attraverso l’osservazione continua.',
                    'adulti' => true,
                    'indirizzo' => 'Contrada Cannavecchia, 92027 Licata AG',
                    'telefono' => '0922.869131',
                    'email' => 'policata@pec.aspag.it',
                    'web' => 'http://www.aspag.it/index.php/il-distretto-ospedaliero/ospedale-di-licata/pronto-soccorso110',
                    'google_maps' => '',
                    'coords' => [
                        'lat' => '37.1071727',
                        'lng' => '13.9246533',
                    ],
                    'data' => $dataCommons,
                ],
                'ps_ribera' => [
                    'id' => 4,
                    'nome' => 'Ribera - Ospedale Fratelli Parlapiano',
                    'descrizione' => 'Ospedale Ribera',
                    'adulti' => true,
                    'indirizzo' => 'Via Circonvallazione - Ribera',
                    'telefono' => '0925.562298',
                    'email' => 'poribera@pec.aspag.it',
                    'web' => 'http://www.aspag.it/index.php/monitoraggio-in-tempo-reale',
                    'google_maps' => 'https://www.google.it/maps/place/presidio+ospedaliero+fratelli+Parlapiano+di+Ribera/@37.493477,13.265719,15z/data=!4m6!3m5!1s0x131a6bf3cfbf7653:0x78f1102a4fd6e5df!8m2!3d37.4922822!4d13.269643!16s%2Fg%2F11nnzrkdbn?hl=it&entry=ttu',
                    'coords' => [
                        'lat' => '37.493477',
                        'lng' => '13.265719',
                    ],
                    'data' => $dataCommons,
                ],
                'ps_sciacca' => [
                    'id' => 5,
                    'nome' => 'Sciacca - Ospedale Giovanni Paolo II',
                    'descrizione' => 'Orari di accesso: Da Lunedì a Domenica h24 Al pronto soccorso si può accedere direttamente, su richiesta del medico di famiglia o di continuità assistenziale, o tramite ambulanza inviata dalla centrale operativa del 118',
                    'adulti' => true,
                    'indirizzo' => 'Via Pompei, 92019 Sciacca AG',
                    'telefono' => '0925/962528',
                    'email' => 'posciacca.medicinaurgenza@aspag.it',
                    'web' => 'http://www.aspag.it/index.php/il-distretto-ospedaliero/ospedale-di-sciacca/medicina-e-chirurgia-urgenza',
                    'google_maps' => 'https://www.google.it/maps/place/Pronto+Soccorso/@37.525705,13.0736286,17z/data=!3m1!4b1!4m6!3m5!1s0x131a46c9b133d5e5:0xef1b1d1a9958fb4f!8m2!3d37.525705!4d13.0736286!16s%2Fg%2F11f24x5lw6?entry=ttu',
                    'coords' => [
                        'lat' => '37.525705',
                        'lng' => '13.0736286',
                    ],
                    'data' => $dataCommons,
                ],
            ]
        ],
    ]
];
