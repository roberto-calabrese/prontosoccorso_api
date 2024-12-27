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
            'title' => 'Indice Sovraffollamento: ',
            'align' => 'emd',
            'key' => 'data.data.extra.indice_sovraffollamento.value'
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
            'key' => 'data.data.extra.indice_sovraffollamento.value',
            'order' => 'asc'
        ]
    ]
];

$dataCommonAspPalermo = [
    'rosso' => [
        'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(2)',
        'extra' => [
            'in_attesa' => [
                'label' => 'In attesa di visita',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(2)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(2)>td:nth-child(2)',
            ],
            'in_osservazione' => [
                'label' => 'Pazienti in osservazione',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(3)>td:nth-child(2)',
            ],
            'totali' => [
                'label' => 'Totali',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(4)>td:nth-child(2)',
            ]
        ]
    ],
    'arancione' => [
        'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
        'extra' => [
            'in_attesa' => [
                'label' => 'In attesa di visita',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(2)>td:nth-child(3)',
            ],
            'in_osservazione' => [
                'label' => 'Pazienti in osservazione',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(3)>td:nth-child(3)',
            ],
            'totali' => [
                'label' => 'Totali',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(4)>td:nth-child(3)',
            ]

        ]
    ],
    'azzurro' => [
        'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
        'extra' => [
            'in_attesa' => [
                'label' => 'In attesa di visita',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(3)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(2)>td:nth-child(3)',
            ],
            'in_osservazione' => [
                'label' => 'Pazienti in osservazione',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(3)>td:nth-child(3)',
            ],
            'totali' => [
                'label' => 'Totali',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(4)>td:nth-child(3)',
            ]

        ]
    ],
    'verde' => [
        'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(4)',
        'extra' => [
            'in_attesa' => [
                'label' => 'In attesa di visita',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(4)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(2)>td:nth-child(4)',
            ],
            'in_osservazione' => [
                'label' => 'Pazienti in osservazione',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(3)>td:nth-child(4)'
            ],
            'totali' => [
                'label' => 'Totali',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(4)',
            ]
        ]
    ],
    'bianco' => [
        'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(5)',
        'extra' => [
            'in_attesa' => [
                'label' => 'In attesa di visita',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(1)>td:nth-child(5)',
            ],
            'in_trattamento' => [
                'label' => 'Pazienti in trattamento',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(2)>td:nth-child(5)',
            ],
            'in_osservazione' => [
                'label' => 'Pazienti in osservazione',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(3)>td:nth-child(5)',
            ],
            'totali' => [
                'label' => 'Totali',
                'selector' => 'body>main>div:nth-child(#R)>table>tbody>tr:nth-child(4)>td:nth-child(5)',
            ]

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
                'in_osservazione' => [
                    'label' => 'Pazienti in osservazione',
                    'value' => null,
                ],
            ]
        ],
    ],
    'extra' => [
        'numero_posti_tecnico' => [
            'label' => 'Num. posti tecnici presidiati',
            'selector' => 'body>main>div:nth-child(#R)>div:nth-child(2)>span:nth-child(3)',
        ],
        'indice_sovraffollamento' => [
            'label' => 'Indice di sovraffollamento',
            'selector' => 'body>main>div:nth-child(#R)>div:nth-child(2)>span:nth-child(5)',
        ],
    ],
];

return [
    'meta' => [
      'slug' => 'palermo',
      'Titolo' => 'Palermo'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'sicilia.palermo',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'ospedaliRiuniti' => [
            'cache' => [
                'key' => 'sicilia.palermo.ospedaliRiuniti',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.ospedaliriunitipalermo.it/amministrazione-trasparente/servizi-erogati/liste-di-attesa/pazienti-in-attesa-al-pronto-soccorso/',
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'presidio_villa_sofia_adulti' => [
                    'id' => 1,
                    'nome' => 'Palermo - Villa Sofia',
                    'descrizione' => 'Ospedali Riuniti Villa Sofia Cervello',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Salerno, 1, 90146 Palermo PA',
                    'telefono' => '091 7804031',
                    'email' => 'direzionepresidio@villasofia.it',
                    'web' => 'https://www.ospedaliriunitipalermo.it/amministrazione-trasparente/servizi-erogati/liste-di-attesa/pazienti-in-attesa-al-pronto-soccorso/',
                    'google_maps' => 'https://www.google.com/maps/place/Piazza+Salerno,+1,+90146+Palermo+PA,+Italia/@38.155978,13.337607,15z/data=!4m6!3m5!1s0x1319e8d80d96bf33:0x96e9216aaa3017f2!8m2!3d38.154867!4d13.33671!16s%2Fg%2F11bw3gq2xv?hl=it&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.155978',
                        'lng' => '13.337607',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(4)>div:nth-child(1)>div:nth-child(2)',
                        ],
                        'giallo' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(4)>div:nth-child(2)>div:nth-child(2)',
                        ],
                        'verde' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(4)>div:nth-child(3)>div:nth-child(2)',
                        ],
                        'bianco' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(4)>div:nth-child(4)>div:nth-child(2)',
                        ],
                        'totali' => [
                            'selector' => 'div.villaSofia>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.villaSofia>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                                ],
                                'totali' => [
                                    'label' => 'Pazienti totali nella struttura',
                                    'selector' => 'div.villaSofia>div:nth-child(3)>div:nth-child(1)>div:nth-child(2)',
                                ],
                            ],
                        ],
                        'extra' => [
                            'in_attesa' => [
                                'label' => 'Pazienti in attesa',
                                'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                            ],
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(5)',
                            ],
                            'aggiornamento' => [
                                'label' => 'Aggiornato al',
                                'selector' => 'div.olo-row-dati-aggiornati-al',
                            ],
                        ],
                    ]
                ],
                'presidio_villa_sofia_pediatrico' => [
                    'id' => 2,
                    'nome' => 'Palermo - Villa Sofia',
                    'descrizione' => 'Ospedali Riuniti Villa Sofia Cervello',
                    'adulti' => false,
                    'indirizzo' => 'Via Trabucco, 180, 90146 Palermo PA',
                    'telefono' => '0916802111',
                    'sala_visite' => '+39 091 6802014  / +39 091 6802015',
                    'triage' => '+39 091 6802013',
                    'caposala' => '+39 091 6802072',
                    'info' => 'Per i pazienti di PSP che necessitano di un inquadramento diagnostico non urgente e/o di un follow up neurologico è attivo l’Ambulatorio di Neurologia pediatrica e Medicina del Sonno',
                    'email' => 'ps.pediatrico@villasofia.it',
                    'volumi' => 'In epoca pre pandemica  ( fino al 2019)  il PS Pediatrico vanta  29.077 accessi/anno con un tasso di ospedalizzazione del 5%, una percentuale di codici in emergenza/urgenza del 22% e tempi di attesa medi di 48,28 min.  2983 pazienti sono stati assistiti in OBI con un tempo medio di permanenza pari a 20 ore e una percentuale di dimessi del 83% e ricoveri 0,2%. Sono state erogate complessivamente 185.693 prestazioni specialistiche, di cui 83.949 trattate  esclusivamente in Pronto Soccorso. L’attività di trauma center è rappresentata dal 25% degli accessi (7476 ) di cui 1560 (20%) in emergenza/urgenza.',
                    'web' => 'https://www.ospedaliriunitipalermo.it/cervello.html',
                    'google_maps' => 'https://www.google.com/maps/place/Piazza+Salerno,+1,+90146+Palermo+PA,+Italia/@38.155978,13.337607,15z/data=!4m6!3m5!1s0x1319e8d80d96bf33:0x96e9216aaa3017f2!8m2!3d38.154867!4d13.33671!16s%2Fg%2F11bw3gq2xv?hl=it&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.155978',
                        'lng' => '13.337607',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(4)>div:nth-child(1)>div:nth-child(2)',
                        ],
                        'giallo' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(4)>div:nth-child(2)>div:nth-child(2)',
                        ],
                        'verde' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(4)>div:nth-child(3)>div:nth-child(2)',
                        ],
                        'bianco' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(4)>div:nth-child(4)>div:nth-child(2)',
                        ],
                        'totali' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                                ],
                                'totali' => [
                                    'label' => 'Pazienti totali nella struttura',
                                    'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(3)>div:nth-child(1)>div:nth-child(2)',
                                ],
                            ],
                        ],
                        'extra' => [
                            'in_attesa' => [
                                'label' => 'Pazienti in attesa',
                                'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                            ],
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(5)',
                            ],
                            'aggiornamento' => [
                                'label' => 'Aggiornato al',
                                'selector' => 'div.olo-row-dati-aggiornati-al',
                            ],
                        ],
                    ]
                ],
                'presidio_cervello_adulti' => [
                    'id' => 3,
                    'nome' => 'Palermo - Cervello',
                    'descrizione' => 'Ospedali Riuniti Villa Sofia Cervello',
                    'adulti' => true,
                    'indirizzo' => 'Via Trabucco, 180, 90146 Palermo PA',
                    'telefono' => ' 091 680 2111',
                    'email' => 'direzionepresidio@villasofia.it',
                    'google_maps' => 'https://maps.app.goo.gl/vY4RATYz7ePA2Pe76',
                    'web' => 'https://www.google.it/maps/place/Ospedali+Riuniti+Villa+Sofia-+Cervello+Pronto+Soccorso/@38.1545298,13.3138741,17z/data=!3m1!4b1!4m6!3m5!1s0x1319e8d8183d228f:0x456f6e94feddec13!8m2!3d38.1545298!4d13.3138741!16s%2Fg%2F11fyx8jlns?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.1545298',
                        'lng' => '13.3138741',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(3)>div:nth-child(4)>div:nth-child(1)>div:nth-child(2)',
                        ],
                        'giallo' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(3)>div:nth-child(4)>div:nth-child(2)>div:nth-child(2)',
                        ],
                        'verde' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(3)>div:nth-child(4)>div:nth-child(3)>div:nth-child(2)',
                        ],
                        'bianco' => [
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(3)>div:nth-child(4)>div:nth-child(4)>div:nth-child(2)',
                        ],
                        'totali' => [
                            'selector' => 'div.cervello>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'div.cervello>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                                ],
                                'totali' => [
                                    'label' => 'Pazienti totali nella struttura',
                                    'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(3)>div:nth-child(3)>div:nth-child(1)>div:nth-child(2)',
                                ],
                            ],
                        ],
                        'extra' => [
                            'in_attesa' => [
                                'label' => 'Pazienti in attesa',
                                'value' => null,
                                'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(3)>div:nth-child(3)>div:nth-child(2)>div:nth-child(2)',
                            ],
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(3)>div:nth-child(5)',
                            ],
                            'aggiornamento' => [
                                'label' => 'Aggiornato al',
                                'selector' => 'div.olo-row-dati-aggiornati-al',
                            ],
                            //
                        ],
                    ]
                ]
            ]
        ],
        'arsCivico' => [
            'cache' => [
                'key' => 'sicilia.palermo.arsCivico',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.arnascivico.it/index.php?option=com_content&view=article&id=3415&catid=24&Itemid=139',
            'jobClass' => \App\Jobs\Sicilia\Palermo\ArsCivicoJob::class,
            'data' => [
                'presidio_civico_adulti' => [
                    'id' => 4,
                    'nome' => 'Palermo - Civico',
                    'descrizione' => 'Pronto Soccorso Adulti',
                    'adulti' => true,
                    'indirizzo' => 'Via Carmelo Lazzaro, 4, 90127 Palermo PA',
                    'telefono' => '091 666 1111',
                    'email' => 'ospedalecivicopa@pec.it',
                    'web' => 'https://www.arnascivico.it',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Civico+di+Palermo/@38.1042334,13.3560857,17z/data=!3m1!4b1!4m6!3m5!1s0x1319ef79f9df9793:0x9018c72eca13ef10!8m2!3d38.1042334!4d13.3560857!16s%2Fg%2F11f_dzzpkj?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.1042334',
                        'lng' => '13.3560857',
                    ],
                    'data' => [
                        'calculate_selector' => 'div.item-page>div:nth-child(4)>table:nth-child(7)>tbody>tr:nth-child(REPLACE)',
                        'extra' => [
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(5)>span>strong:nth-child(1)>span',
                            ],
                            'numero_pazienti_con_una_permanenza24h' => [
                                'label' => 'Numero pazienti con una permanenza <24h',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(5)>span>strong:nth-child(3)',
                            ],
                            'numero_pazienti_con_una_permanenza_compresa_tra24h_e48h' => [
                                'label' => 'Numero pazienti con una permanenza compresa tra 24h e 48h',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(5)>span>strong:nth-child(5)',
                            ],
                            'numero_pazienti_con_una_permanenza48h' => [
                                'label' => 'Numero pazienti con una permanenza >48h',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(5)>span>strong:nth-child(7)',
                            ],
                            'numero_posti_tecnici_presidiati_del_ps_fissati_dalla_direzione_aziendale' => [
                                'label' => 'Numero posti tecnici presidiati del PS fissati dalla Direzione Aziendale',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(5)>span>strong:nth-child(9)',
                            ],
                            'numero_posti_riferibili_alla_struttura9401_semintensiva' => [
                                'label' => 'Numero posti riferibili alla struttura 9401 semintensiva',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(5)>span>strong:nth-child(11)',
                            ],
                            'efficienza_operativa_standard' => [
                                'label' => 'Efficienza operativa (Standard <= 0,05)',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(5)>span>strong:nth-child(13)',
                            ],
                        ]
                    ]
                ],
                'presidio_civico_pediatrico' => [
                    'id' => 5,
                    'nome' => 'Palermo - Civico "Di Cristina"',
                    'descrizione' => 'L\'ospedale specializzato pediatrico "Di Cristina", sede del Dipartimento di Pediatria, è dotato di un pronto soccorso e di 15 unità operative di diagnosi e cura.',
                    'adulti' => false,
                    'indirizzo' => 'Via Carmelo Lazzaro, 4, 90127 Palermo PA',
                    'telefono' => '091 6666012',
                    'email' => 'ospedalecivicopa@pec.it',
                    'web' => 'https://www.arnascivico.it',
                    'google_maps' => 'https://www.google.it/maps/place/Via+dei+Benedettini,+5,+90134+Palermo+PA/@38.1099461,13.3548131,155m/data=!3m1!1e3!4m6!3m5!1s0x1319ef630c18c8ad:0xe0dc4b3a6500f882!8m2!3d38.1099002!4d13.3547353!16s%2Fg%2F11c4kh9b5z?hl=it&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.1099461',
                        'lng' => '13.3548131',
                    ],
                    'data' => [
                        'calculate_selector' => 'div.item-page>div:nth-child(4)>table:nth-child(13)>tbody>tr:nth-child(REPLACE)',
                        'extra' => [
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(11)>span>strong:nth-child(1)>span',
                            ],
                            'numero_pazienti_con_una_permanenza24h' => [
                                'label' => 'Numero pazienti con una permanenza <24h',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(11)>span>strong:nth-child(3)',
                            ],
                            'numero_pazienti_con_una_permanenza_compresa_tra24h_e48h' => [
                                'label' => 'Numero pazienti con una permanenza compresa tra 24h e 48h',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(11)>span>strong:nth-child(5)',
                            ],
                            'numero_pazienti_con_una_permanenza48h' => [
                                'label' => 'Numero pazienti con una permanenza >48h',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(11)>span>strong:nth-child(7)',
                            ],
                            'numero_posti_tecnici_presidiati_del_ps_fissati_dalla_direzione_aziendale' => [
                                'label' => 'Numero posti tecnici presidiati del PS fissati dalla Direzione Aziendale',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(11)>span>strong:nth-child(9)',
                            ],
                            'efficienza_operativa_standard' => [
                                'label' => 'Efficienza operativa (Standard <= 0,05)',
                                'selector' => 'div.item-page>div:nth-child(4)>p:nth-child(11)>span>strong:nth-child(11)',
                            ],
                        ]
                    ]
                ],
            ]
        ],
        'policlinico' => [
            'cache' => [
                'key' => 'sicilia.palermo.policlinico',
                'ttlMinute' => 1
            ],
             'url' => 'https://www.policlinico.pa.it/o/PoliclinicoPaRestBuilder/v1.0/ProntoSoccorso',
             'url_indici' => 'https://www.policlinico.pa.it/o/PoliclinicoPaRestBuilder/v1.0/ProntoSoccorsoIndici',
            'headers' => [
                'Referer' => 'https://www.policlinico.pa.it/web/guest',
                'User-Agent' => $userAgent,
                'Origin' => 'https://www.policlinico.pa.it/web/guest',
            ],
            'jobClass' => \App\Jobs\Sicilia\Palermo\PoliclinicoAJaxJob::class,
            'data' => [
                'policlinico_adulti' => [
                    'id' => 6,
                    'nome' => 'Palermo - Policlinico',
                    'descrizione' => '"Paolo Giaccone" - Azienda Ospedaliera dell\'Università degli Studi di Palermo',
                    'adulti' => true,
                    'indirizzo' => 'Via del Vespro, 129 90127 Palermo',
                    'telefono' => '091 6551111',
                    'email' => 'protocollo@cert.policlinico.pa.it ',
                    'web' => 'https://www.policlinico.pa.it/web/guest',
                    'google_maps' => 'https://www.google.it/maps/place/AZIENDA+OSPEDALIERA+UNIVERSITARIA+POLICLINICO+PAOLO+GIACCONE/@38.1044938,13.3625445,16z/data=!3m1!4b1!4m6!3m5!1s0x1319e587f5bc639f:0xcbac5e0f9d0ba0e4!8m2!3d38.1044938!4d13.3625445!16s%2Fg%2F1tgfsk1z?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.1044938',
                        'lng' => '13.3625445',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'pazientiInAttesa.Rosso (1)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.Rosso (1)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInCarico.Rosso (1)',
                                ],
                                'carichi_urgenti' => [
                                    'label' => 'Carichi urgenti',
                                    'selector' => 'carichiUrgenza.Rosso (1)',
                                ],
                                'tempo_attesa' => [
                                    'label' => 'Tempi medi di attesa',
                                    'selector' => 'tempiMediAttesa.Rosso (1)',
                                ]
                            ]
                        ],
                        'arancione' => [
                            'selector' => 'pazientiInAttesa.Arancione (2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.Arancione (2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInCarico.Arancione (2)',
                                ],
                                'carichi_urgenti' => [
                                    'label' => 'Carichi urgenti',
                                    'selector' => 'carichiUrgenza.Arancione (2)',
                                ],
                                'tempo_attesa' => [
                                    'label' => 'Tempi medi di attesa',
                                    'selector' => 'tempiMediAttesa.Arancione (2)',
                                ]
                            ]
                        ],
                        'azzurro' => [
                            'selector' => 'pazientiInAttesa.Azzurro (3)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.Azzurro (3)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInCarico.Azzurro (3)',
                                ],
                                'carichi_urgenti' => [
                                    'label' => 'Carichi urgenti',
                                    'selector' => 'carichiUrgenza.Azzurro (3)',
                                ],
                                'tempo_attesa' => [
                                    'label' => 'Tempi medi di attesa',
                                    'selector' => 'tempiMediAttesa.Azzurro (3)',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'pazientiInAttesa.Verde (4)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.Verde (4)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInCarico.Verde (4)',
                                ],
                                'carichi_urgenti' => [
                                    'label' => 'Carichi urgenti',
                                    'selector' => 'carichiUrgenza.Verde (4)',
                                ],
                                'tempo_attesa' => [
                                    'label' => 'Tempi medi di attesa',
                                    'selector' => 'tempiMediAttesa.Verde (4)',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'pazientiInAttesa.Bianco (5)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.Bianco (5)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInCarico.Bianco (5)',
                                ],
                                'carichi_urgenti' => [
                                    'label' => 'Carichi urgenti',
                                    'selector' => 'carichiUrgenza.Bianco (5)',
                                ],
                                'tempo_attesa' => [
                                    'label' => 'Tempi medi di attesa',
                                    'selector' => 'tempiMediAttesa.Bianco (5)',
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
                                            'pazientiInAttesa.Rosso (1)',
                                            'pazientiInAttesa.Arancione (2)',
                                            'pazientiInAttesa.Azzurro (3)',
                                            'pazientiInAttesa.Verde (4)',
                                            'pazientiInAttesa.Bianco (5)',
                                        ],
                                    ],
                                    'in_trattamento' => [
                                        'label' => 'Pazienti in trattamento',
                                        'fields' => [
                                            'pazientiInCarico.Rosso (1)',
                                            'pazientiInCarico.Arancione (2)',
                                            'pazientiInCarico.Azzurro (3)',
                                            'pazientiInCarico.Verde (4)',
                                            'pazientiInCarico.Bianco (5)',
                                        ],
                                    ],
                                    'carichi_urgenti' => [
                                        'label' => 'Carichi urgenti',
                                        'fields' => [
                                            'carichiUrgenza.Rosso (1)',
                                            'carichiUrgenza.Arancione (2)',
                                            'carichiUrgenza.Azzurro (3)',
                                            'carichiUrgenza.Verde (4)',
                                            'carichiUrgenza.Bianco (5)',
                                        ],
                                    ],
                                ]
                            ],
                        ]
                    ]
                ],
            ]
        ],
        'ingrassia' => [
            'cache' => [
                'key' => 'sicilia.palermo.ingrassia',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.asppalermo.org/attese_ps/index_mod2.php',
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'palermo_ingrassia_adulti' => [
                    'id' => 7,
                    'nome' => 'Palermo - Ingrassia',
                    'descrizione' => 'Ingrassia',
                    'adulti' => true,
                    'indirizzo' => ' C.so Calatafimi, 1002, 90131 Palermo PA',
                    'telefono' => '091 703 3615',
                    'email' => ' - ',
                    'web' => 'https://www.asppalermo.org/attese_ps/',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Ingrassia,+Cral/@38.0932568,13.3099573,16z/data=!3m1!4b1!4m6!3m5!1s0x1319ee52f1b0555f:0xf085cb35f4bff4ab!8m2!3d38.0932568!4d13.3099573!16s%2Fg%2F11cjn2whw7?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'replaceSearch' => '/\#R/',
                    'replaceTo' => [1],
                    'coords' => [
                        'lat' => '38.0932568',
                        'lng' => '13.3099573',
                    ],
                    'data' => $dataCommonAspPalermo
                ],
                'partinico_civico' => [
                    'id' => 8,
                    'nome' => 'Partinico - Civico',
                    'descrizione' => 'Ospedale Civico Partinico',
                    'adulti' => true,
                    'indirizzo' => 'Via Circonvallazione, 1, 90047 Partinico PA',
                    'telefono' => '091 891 1111',
                    'email' => ' - ',
                    'web' => 'https://www.asppalermo.org/attese_ps/index_mod2.php',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Civico+Partinico/@38.037556,13.11546,763m/data=!3m2!1e3!4b1!4m6!3m5!1s0x13198c4ded139531:0x858cd54fe1511879!8m2!3d38.037556!4d13.11546!16s%2Fg%2F1tlr2s5g?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'replaceSearch' => '/\#R/',
                    'replaceTo' => [4],
                    'coords' => [
                        'lat' => '38.037556',
                        'lng' => '13.11546',
                    ],
                    'data' => $dataCommonAspPalermo
                ],
                'corleone_ps' => [
                    'id' => 9,
                    'nome' => 'Corleone - Ospedale dei Bianchi',
                    'descrizione' => 'PRONTO SOCCORSO - P.O. "DEI BIANCHI" DI CORLEONE',
                    'adulti' => true,
                    'indirizzo' => 'Via Don Giovanni Colletto, 90034 Corleone PA',
                    'telefono' => '091 845 0100',
                    'email' => ' - ',
                    'web' => 'https://www.asppalermo.org/attese_ps/index_mod2.php',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+dei+Bianchi/@37.8169335,13.2984776,765m/data=!3m2!1e3!4b1!4m6!3m5!1s0x131a1c772404f9cb:0xef406def016eaa7!8m2!3d37.8169335!4d13.2984776!16s%2Fg%2F11cjpc6w9d?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'replaceSearch' => '/\#R/',
                    'replaceTo' => [7],
                    'coords' => [
                        'lat' => '37.8169335',
                        'lng' => '13.2984776',
                    ],
                    'data' => $dataCommonAspPalermo
                ],
                'petraliasottana_ps' => [
                    'id' => 10,
                    'nome' => 'Petralia Sottana - Ospedale Madonna SS.ma Dell\'Alto',
                    'descrizione' => 'Ospedale Madonna SS.ma Dell\'Alto',
                    'adulti' => true,
                    'indirizzo' => 'Via Esterna Sant\'Elia, 90027 Petralia Sottana PA',
                    'telefono' => '0921 682026',
                    'email' => ' - ',
                    'web' => 'https://www.asppalermo.org/attese_ps/index_mod2.php',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Madonna+SS.ma+Dell\'Alto+-+Pronto+Soccorso/@37.8187079,14.0911795,765m/data=!3m2!1e3!4b1!4m6!3m5!1s0x131732a374269b23:0xb187f42912ef38e7!8m2!3d37.8187079!4d14.0911795!16s%2Fg%2F11f_c02yhc?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'replaceSearch' => '/\#R/',
                    'replaceTo' => [10],
                    'coords' => [
                        'lat' => '37.8187079',
                        'lng' => '14.0911795',
                    ],
                    'data' => $dataCommonAspPalermo
                ],
                'terminiimerese_ps' => [
                    'id' => 11,
                    'nome' => 'Termini Imerese - Presidio Ospedalierio Salvatore Cimino',
                    'descrizione' => 'Presidio Ospedalierio Salvatore Cimino Pronto Soccorso',
                    'adulti' => true,
                    'indirizzo' => 'Via Salvatore Cimino, 2, 90141 Termini Imerese PA',
                    'telefono' => '091 815 1111',
                    'email' => ' - ',
                    'web' => 'https://www.asppalermo.org/attese_ps/index_mod2.php',
                    'google_maps' => 'https://www.google.it/maps/place/Presidio+Ospedalierio+Salvatore+Cimino+Pronto+Soccorso/@37.9834983,13.6860693,764m/data=!3m2!1e3!4b1!4m6!3m5!1s0x1317505703055555:0x9413d5cafaa20d3e!8m2!3d37.9834983!4d13.6860693!16s%2Fg%2F11gbf8fct1?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D',
                    'replaceSearch' => '/\#R/',
                    'replaceTo' => [13],
                    'coords' => [
                        'lat' => '37.9834983',
                        'lng' => '13.6860693',
                    ],
                    'data' => $dataCommonAspPalermo
                ],
            ]
        ],
        'buccheri' => [
            'cache' => [
                'key' => 'sicilia.palermo.buccheri',
                'ttlMinute' => 1
            ],
            'url' => 'https://servizionline.provinciaromanafbf.it/palermo/monitorps/ajax/dati-monitor-ps/01/G',
            'headers' => [
                'Referer' => 'https://servizionline.provinciaromanafbf.it/palermo/monitorps/portal-view/01/G',
                'User-Agent' => $userAgent,
                'Origin' => 'https://servizionline.provinciaromanafbf.it',
            ],
            'method' => 'POST',
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'buccheri_adulti' => [
                    'id' => 12,
                    'nome' => 'Palermo - Buccheri La Ferla',
                    'descrizione' => 'Fatebenefratelli ',
                    'adulti' => true,
                    'indirizzo' => 'Via Messina Marine, 197, 90123 Palermo PA',
                    'telefono' => '091 479111',
                    'email' => 'urp@fbfpa.it',
                    'web' => 'https://www.ospedalebuccherilaferla.it',
                    'google_maps' => 'https://www.google.it/maps/place/Ospedale+Buccheri+La+Ferla/@38.1058898,13.3859316,17z/data=!3m1!4b1!4m6!3m5!1s0x1319e4510cdbca39:0x1ceaed4b54422ed4!8m2!3d38.1058898!4d13.3859316!16s%2Fg%2F1tf0sqth?entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D',
                    'coords' => [
                        'lat' => '38.1058898',
                        'lng' => '13.3859316',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'pazientiInAttesa.totaleCodiciRossi',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.totaleCodiciRossi',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInTrattamento.totaleCodiciRossi',
                                ],
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'pazientiInAttesa.totaleCodiciGialli',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.totaleCodiciGialli',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInTrattamento.totaleCodiciGialli',
                                ],

                            ]
                        ],
                        'verde' => [
                            'selector' => 'pazientiInAttesa.totaleCodiciVerdi',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.totaleCodiciVerdi',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInTrattamento.totaleCodiciVerdi',
                                ],
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'pazientiInAttesa.totaleCodiciBianchi',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.totaleCodiciBianchi',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInTrattamento.totaleCodiciBianchi',
                                ],

                            ]
                        ],
                        'totali' => [
                            'selector' => 'pazientiInAttesa.totalePazienti',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'Pazienti in attesa',
                                    'selector' => 'pazientiInAttesa.totalePazienti',
                                ],
                                'in_trattamento' => [
                                    'label' => 'Pazienti in trattamento',
                                    'selector' => 'pazientiInTrattamento.totalePazienti',
                                ],

                            ]
                        ],
                        'extra' => [
                            'access_giorno' => [
                                'label' => 'Accessi del giorno',
                                'selector' => 'numeroAccessiProntoSoccorsoOdierno',
                            ],
                            'accessi_anno' => [
                                'label' => 'Accessi dell\' Anno',
                                'selector' => 'numeroAccessiProntoSoccorsoAnno',
                            ],
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'indicatoreSovraffollamento.valore'
                            ]
                        ],
                    ]
                ],
            ]
        ],
    ]
];
