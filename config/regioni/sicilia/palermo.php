<?php

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Safari/537.36';

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
                    'nome' => 'Villa Sofia',
                    'descrizione' => 'Pronto Soccorso Adulti',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Salerno, 1, 90146 Palermo PA',
                    'telefono' => '091 7804031',
                    'email' => 'direzionepresidio@villasofia.it',
                    'web' => 'https://www.ospedaliriunitipalermo.it/amministrazione-trasparente/servizi-erogati/liste-di-attesa/pazienti-in-attesa-al-pronto-soccorso/',
                    'google_maps' => 'https://maps.app.goo.gl/vY4RATYz7ePA2Pe76',
                    'coords' => [
                        'lat' => '38.149290',
                        'lng' => '13.314810',
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
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(4)>div:nth-child(3)>div:nth-child(1)>div:nth-child(2)',
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
                    'nome' => 'Villa Sofia',
                    'descrizione' => 'Pronto Soccorso Pediatrico',
                    'adulti' => false,
                    'indirizzo' => 'Piazza Salerno, 1, 90146 Palermo PA',
                    'telefono' => '091 6802015',
                    'email' => 'direzionepresidio@villasofia.it',
                    'web' => 'https://www.ospedaliriunitipalermo.it/amministrazione-trasparente/servizi-erogati/liste-di-attesa/pazienti-in-attesa-al-pronto-soccorso/',
                    'coords' => [
                        'lat' => '38.149290',
                        'lng' => '13.314810',
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
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(5)>div:nth-child(3)>div:nth-child(1)>div:nth-child(2)',
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
                    'nome' => 'Cervello',
                    'descrizione' => 'Presidio Cervello Adulti',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Salerno, 1, 90146 Palermo PA',
                    'telefono' => '091 6802515',
                    'email' => 'direzionepresidio@villasofia.it',
                    'web' => 'https://www.ospedaliriunitipalermo.it/amministrazione-trasparente/servizi-erogati/liste-di-attesa/pazienti-in-attesa-al-pronto-soccorso/',
                    'coords' => [
                        'lat' => '38.149290',
                        'lng' => '13.314810',
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
                            'selector' => 'div.olo-container-pronto-soccorso>div:nth-child(3)>div:nth-child(3)>div:nth-child(1)>div:nth-child(2)',
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
                    'nome' => 'Civico',
                    'descrizione' => 'Pronto Soccorso Adulti',
                    'adulti' => true,
                    'indirizzo' => 'Via Carmelo Lazzaro, 4, 90127 Palermo PA',
                    'telefono' => '091 666 1111',
                    'email' => 'ospedalecivicopa@pec.it',
                    'web' => 'https://www.arnascivico.it',
                    'coords' => [
                        'lat' => '38.103724',
                        'lng' => '13.355288',
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
                    'nome' => 'Civico',
                    'descrizione' => 'Pronto Soccorso Pediatrico',
                    'adulti' => false,
                    'indirizzo' => 'Via Carmelo Lazzaro, 4, 90127 Palermo PA',
                    'telefono' => '091 666 1111',
                    'email' => 'ospedalecivicopa@pec.it',
                    'web' => 'https://www.arnascivico.it',
                    'coords' => [
                        'lat' => '38.103724',
                        'lng' => '13.355288',
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
            'url' => 'http://www.policlinico.pa.it/portal/',
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'policlinico_adulti' => [
                    'id' => 6,
                    'nome' => 'Policlinico',
                    'descrizione' => '"Paolo Giaccone" - Azienda Ospedaliera dell\'Università degli Studi di Palermo',
                    'adulti' => true,
                    'indirizzo' => 'Via del Vespro, 129 90127 Palermo',
                    'telefono' => '091 6551111',
                    'email' => 'protocollo@cert.policlinico.pa.it ',
                    'web' => 'https://www.policlinico.pa.it',
                    'coords' => [
                        'lat' => '38.103724',
                        'lng' => '13.355288',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'div.psDiv>div:nth-child(5)>span:nth-child(4)>strong>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'div.psDiv>div:nth-child(13)>span:nth-child(4)>strong>span',
                                ]
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'div.psDiv>div:nth-child(6)>span:nth-child(4)>strong>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'div.psDiv>div:nth-child(14)>span:nth-child(4)>strong>span',
                                ]
                            ]
                        ],
                        'verde' => [
                            'selector' => 'div.psDiv>div:nth-child(7)>span:nth-child(4)>strong>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'div.psDiv>div:nth-child(15)>span:nth-child(4)>strong>span',
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'div.psDiv>div:nth-child(8)>span:nth-child(4)>strong>span',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'div.psDiv>div:nth-child(16)>span:nth-child(4)>strong>span',
                                ]
                            ]
                        ],
                        'totali' => [
                            'selector' => 'div.psDiv>p:nth-child(3)>span>strong',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'div.psDiv>p:nth-child(11)>span>strong',
                                ]
                            ]
                        ],
                        'extra' => [
                            'numero_posti_tecnico' => [
                                'label' => 'Num. posti tecnici presidiati',
                                'selector' => 'div.psDiv>p:nth-child(18)>span>span>strong',
                            ],
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'div.psDiv>p:nth-child(18)>span>strong',
                            ],
                            'efficienza_operativa' => [
                                'label' => 'Efficienza operativa standard',
                                'selector' => 'div.psDiv>p:nth-child(18)>span>span>span>strong',
                            ],
                            'permanenza_24' => [
                                'label' => 'Permanenza entro 24h',
                                'selector' => 'div.psDiv>p:nth-child(18)>span>span>span>span:nth-child(4)>strong>span',
                            ],
                            'permanenza_24_48' => [
                                'label' => 'Permanenza tra 24h e 48h  4 paz.',
                                'selector' => 'div.psDiv>p:nth-child(18)>span>span>span>span:nth-child(7)>strong>span',
                            ],
                            'permanenza_48' => [
                                'label' => 'Permanenza oltre 48h  0 paz.',
                                'selector' => 'div.psDiv>p:nth-child(18)>span>span>span>span:nth-child(10)>strong>span',
                            ],
                        ],
                    ]
                ],
            ]
        ],
        'ingrassia' => [
            'cache' => [
                'key' => 'sicilia.palermo.ingrassia',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.asppalermo.org/attese_ps/',
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'ingrassia_adulti' => [
                    'id' => 7,
                    'nome' => 'Ingrassia',
                    'descrizione' => 'Ingrassia',
                    'adulti' => true,
                    'indirizzo' => ' C.so Calatafimi, 1002, 90131 Palermo PA',
                    'telefono' => '091 703 3615',
                    'email' => ' - ',
                    'web' => 'https://www.asppalermo.org/attese_ps/',
                    'coords' => [
                        'lat' => '38.103724',
                        'lng' => '13.355288',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(2)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(2)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'In trattamento',
                                    'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(2)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'In osservazione',
                                    'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(2)
    ',
                                ]

                            ]
                        ],
                        'giallo' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(3)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(3)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'In trattamento',
                                    'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(3)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'In osservazione',
                                    'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(3)',
                                ]

                            ]
                        ],
                        'verde' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(4)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(4)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'In trattamento',
                                    'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(4)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'In osservazione',
                                    'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(4)'
                                ]
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'table.table>tbody>tr:nth-child(4)>td:nth-child(5)',
                            'extra' => [
                                'in_attesa' => [
                                    'label' => 'In attesa di visita',
                                    'selector' => 'table.table>tbody>tr:nth-child(1)>td:nth-child(5)',
                                ],
                                'in_trattamento' => [
                                    'label' => 'In trattamento',
                                    'selector' => 'table.table>tbody>tr:nth-child(2)>td:nth-child(5)',
                                ],
                                'in_osservazione' => [
                                    'label' => 'In osservazione',
                                    'selector' => 'table.table>tbody>tr:nth-child(3)>td:nth-child(5)',
                                ]

                            ]
                        ],
                        'totali' => [
                            'selector' => 'body>main>div>div:nth-child(4)>span:nth-child(1)',
                        ],
                        'extra' => [
                            'numero_posti_tecnico' => [
                                'label' => 'Num. posti tecnici presidiati',
                                'selector' => 'div.text-monospace>span:nth-child(3)',
                            ],
                            'indice_sovraffollamento' => [
                                'label' => 'Indice di sovraffollamento',
                                'selector' => 'div.text-monospace>span:nth-child(5)',
                            ],
                        ],
                    ]
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
            'jobClass' => \App\Jobs\GenericAJaxJob::class,
            'data' => [
                'buccheri_adulti' => [
                    'id' => 8,
                    'nome' => 'Buccheri La Ferla',
                    'descrizione' => 'Fatebenefratelli ',
                    'adulti' => true,
                    'indirizzo' => 'Via Messina Marine, 197, 90123 Palermo PA',
                    'telefono' => '091 479111',
                    'email' => 'urp@fbfpa.it',
                    'web' => 'https://www.ospedalebuccherilaferla.it',
                    'coords' => [
                        'lat' => '38.103724',
                        'lng' => '13.355288',
                    ],
                    'data' => [
                        'rosso' => [
                            'selector' => 'pazientiInAttesa.totaleCodiciRossi',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'In Trattamento',
                                    'selector' => 'pazientiInTrattamento.totaleCodiciRossi',
                                ],
                            ]
                        ],
                        'giallo' => [
                            'selector' => 'pazientiInAttesa.totaleCodiciGialli',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'In Trattamento',
                                    'selector' => 'pazientiInTrattamento.totaleCodiciGialli',
                                ],

                            ]
                        ],
                        'verde' => [
                            'selector' => 'pazientiInAttesa.totaleCodiciVerdi',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'In Trattamento',
                                    'selector' => 'pazientiInTrattamento.totaleCodiciVerdi',
                                ],
                            ]
                        ],
                        'bianco' => [
                            'selector' => 'pazientiInAttesa.totaleCodiciBianchi',
                            'extra' => [
                                'in_trattamento' => [
                                    'label' => 'In Trattamento',
                                    'selector' => 'pazientiInTrattamento.totaleCodiciBianchi',
                                ],

                            ]
                        ],
                        'totali' => [
                            'selector' => 'pazientiInAttesa.totalePazienti',
                            'extra' => [
                                'in_visita' => [
                                    'label' => 'In Trattamento',
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
                                'label' => 'Accesso dell\' Anno',
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