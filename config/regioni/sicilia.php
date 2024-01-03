<?php

return [
    'palermo' => [
        'websocket' => [
            'active' => true,
            'channel' => 'sicilia.palermo',
            'event' => 'data'
        ],
        'data' => [
            'ospedaliRiuniti' => [
                'cache' => [
                    'key' => 'sicilia.palermo.ospedaliRiuniti',
                    'ttlMinute' => 1
                ],
                'url' => 'https://www.ospedaliriunitipalermo.it/amministrazione-trasparente/servizi-erogati/liste-di-attesa/pazienti-in-attesa-al-pronto-soccorso/',
                'data' => [
                    'presidio_villa_sofia_adulti' => [
                        'id' => 1,
                        'nome' => 'Presidio Villa Sofia - Pronto Soccorso Adulti',
                        'type' => 'adulti', //TODO TYPE MODEL
                        'indirizzo' => 'Piazza Salerno, 1, 90146 Palermo PA',
                        'telefono' => '091 780 1111',
                        'email' => 'direzionepresidio@villasofia.it',
                        'web' => 'https://www.ospedaliriunitipalermo.it/amministrazione-trasparente/servizi-erogati/liste-di-attesa/pazienti-in-attesa-al-pronto-soccorso/',
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
                        'nome' => 'Presidio Villa Sofia - Pronto Soccorso Adulti',
                        'type' => 'pediatrico',
                        'indirizzo' => 'Piazza Salerno, 1, 90146 Palermo PA',
                        'telefono' => '091 780 1111',
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
                        'id' => 2,
                        'nome' => 'Presidio Cervello - Pronto Soccorso Adulti',
                        'type' => 'adulti',
                        'indirizzo' => 'Piazza Salerno, 1, 90146 Palermo PA',
                        'telefono' => '091 780 1111',
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
                'data' => [
                    'presidio_civico_adulti' => [
                        'id' => 4,
                        'nome' => 'Presidio Civico - Pronto Soccorso Adulti',
                        'type' => 'adulti', //TODO TYPE MODEL
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
                                    'label' => 'Indice Sovraffollamento',
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
                        'id' => 4,
                        'nome' => 'Presidio Civico - Pronto Soccorso Pediatrico',
                        'type' => 'pediatrico', //TODO TYPE MODEL
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
                                    'label' => 'Indice Sovraffollamento',
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
            ]
        ]
    ]
];
