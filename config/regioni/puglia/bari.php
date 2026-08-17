<?php

$userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36';

$tableSettings = [
    'headers' => [
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
            'key' => 'data.data.totali.value',
            'order' => 'desc'
        ]
    ]
];

// Il portale espone i dati con una pagina Liferay per provincia: il codice
// provincia e' l'unico parametro che cambia fra un file e l'altro.
$portlet = 'it_linksmt_pugliasalute_tempiattesa_prontosoccorso_TempiattesaProntosoccorsoPortlet_INSTANCE_CSoLzmrZInpV';
$ns = "_{$portlet}";

$url = 'https://www.sanita.puglia.it/web/guest/pronto-soccorso-e-tempi-di-attesa?' . http_build_query([
    'p_p_id' => $portlet,
    'p_p_lifecycle' => 0,
    'p_p_state' => 'normal',
    'p_p_mode' => 'view',
    "{$ns}_provincia" => '160114',
    "{$ns}_resetCur" => 'false',
    "{$ns}_delta" => 100,
]);

$headers = [
    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    'Accept-Language' => 'it-IT,it;q=0.9',
    'Referer' => 'https://www.sanita.puglia.it/web/guest/pronto-soccorso-e-tempi-di-attesa',
    'User-Agent' => $userAgent,
];

return [
    'meta' => [
        'slug' => 'bari',
        'Titolo' => 'Bari'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'puglia.bari',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola chiamata restituisce tutti i PS della provincia: il campo
        // 'codice' contiene il titolo con cui il portale pubblica la card.
        'pugliaSaluteBari' => [
            'cache' => [
                'key' => 'puglia.bari',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'jobClass' => \App\Jobs\Puglia\PugliaSaluteScrapeJob::class,
            'data' => [
                'policlinico_centrale' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso Centrale - Policlinico di Bari',
                    'nome' => 'Bari - Policlinico, Pronto Soccorso Centrale',
                    'descrizione' => 'Pronto soccorso generale dell\'Azienda Ospedaliero-Universitaria Consorziale Policlinico di Bari.',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Giulio Cesare, 11, 70124 Bari BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/policlinico-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.1116427,16.8594522',
                    'coords' => [
                        'lat' => '41.1116427',
                        'lng' => '16.8594522',
                    ],
                    'data' => [],
                ],
                'policlinico_oculistico' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Oculistica - Policlinico di Bari',
                    'nome' => 'Bari - Policlinico, Pronto Soccorso Oculistico',
                    'descrizione' => 'Pronto soccorso oculistico del Policlinico di Bari, dedicato alle urgenze oftalmologiche.',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Giulio Cesare, 11, 70124 Bari BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/policlinico-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.1116427,16.8594522',
                    'coords' => [
                        'lat' => '41.1116427',
                        'lng' => '16.8594522',
                    ],
                    'data' => [],
                ],
                'policlinico_ostetrico' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso Ostetrico - Policlinico di Bari',
                    'nome' => 'Bari - Policlinico, Pronto Soccorso Ostetrico',
                    'descrizione' => 'Pronto soccorso ostetrico-ginecologico del Policlinico di Bari.',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Giulio Cesare, 11, 70124 Bari BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/policlinico-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.1116427,16.8594522',
                    'coords' => [
                        'lat' => '41.1116427',
                        'lng' => '16.8594522',
                    ],
                    'data' => [],
                ],
                'giovanni_xxiii' => [
                    'id' => 4,
                    'codice' => 'Medicina e Chirurgia d’Accettazione e d’Urgenza Pediatrica  (Pronto Soccorso Pediatrico)',
                    'nome' => 'Bari - Ospedale Pediatrico Giovanni XXIII',
                    'descrizione' => 'Pronto soccorso pediatrico dell\'Ospedale Giovanni XXIII, presidio dell\'AOU Policlinico di Bari.',
                    'adulti' => false,
                    'indirizzo' => 'Via Giovanni Amendola, 207, 70126 Bari BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/policlinico-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.0986477,16.8878149',
                    'coords' => [
                        'lat' => '41.0986477',
                        'lng' => '16.8878149',
                    ],
                    'data' => [],
                ],
                'san_paolo' => [
                    'id' => 5,
                    'codice' => 'Pronto Soccorso -  S. Paolo - Bari',
                    'nome' => 'Bari - Ospedale San Paolo',
                    'descrizione' => 'Presidio ospedaliero San Paolo, ASL Bari.',
                    'adulti' => true,
                    'indirizzo' => 'Via Caposcardicchio, 1, 70123 Bari BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.1176388,16.7800018',
                    'coords' => [
                        'lat' => '41.1176388',
                        'lng' => '16.7800018',
                    ],
                    'data' => [],
                ],
                'di_venere' => [
                    'id' => 6,
                    'codice' => 'Pronto Soccorso - Di Venere - Bari',
                    'nome' => 'Bari - Ospedale Di Venere',
                    'descrizione' => 'Presidio ospedaliero Di Venere a Carbonara di Bari, ASL Bari.',
                    'adulti' => true,
                    'indirizzo' => 'Via Ospedale Di Venere, 1, 70131 Bari BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.0759800,16.8629247',
                    'coords' => [
                        'lat' => '41.0759800',
                        'lng' => '16.8629247',
                    ],
                    'data' => [],
                ],
                'altamura' => [
                    'id' => 7,
                    'codice' => 'Pronto Soccorso - Altamura',
                    'nome' => 'Altamura - Ospedale della Murgia Fabio Perinei',
                    'descrizione' => 'Ospedale della Murgia "Fabio Perinei", presidio ospedaliero dell\'ASL Bari al servizio dell\'area murgiana.',
                    'adulti' => true,
                    'indirizzo' => 'Strada Statale 96, km 73,800, 70022 Altamura BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.8202031,16.4701193',
                    'coords' => [
                        'lat' => '40.8202031',
                        'lng' => '16.4701193',
                    ],
                    'data' => [],
                ],
                'putignano' => [
                    'id' => 8,
                    'codice' => 'Pronto Soccorso - Putignano',
                    'nome' => 'Putignano - Ospedale Santa Maria degli Angeli',
                    'descrizione' => 'Presidio ospedaliero Santa Maria degli Angeli di Putignano, ASL Bari.',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Padre Pio, 70017 Putignano BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.8521875,17.1183389',
                    'coords' => [
                        'lat' => '40.8521875',
                        'lng' => '17.1183389',
                    ],
                    'data' => [],
                ],
                'monopoli_fasano' => [
                    'id' => 9,
                    'codice' => 'Pronto Soccorso - Monopoli Fasano',
                    'nome' => 'Monopoli - Ospedale del Sud-Est Barese Monopoli-Fasano',
                    'descrizione' => 'Ospedale del Sud-Est Barese, presidio unico per i bacini di Monopoli e Fasano.',
                    'adulti' => true,
                    'indirizzo' => 'Contrada Lamalunga, 70043 Monopoli BA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-bari',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.8711737,17.3311610',
                    'coords' => [
                        'lat' => '40.8711737',
                        'lng' => '17.3311610',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
