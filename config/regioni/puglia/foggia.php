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
    "{$ns}_provincia" => '160115',
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
        'slug' => 'foggia',
        'Titolo' => 'Foggia'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'puglia.foggia',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola chiamata restituisce tutti i PS della provincia: il campo
        // 'codice' contiene il titolo con cui il portale pubblica la card.
        'pugliaSaluteFoggia' => [
            'cache' => [
                'key' => 'puglia.foggia',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'jobClass' => \App\Jobs\Puglia\PugliaSaluteScrapeJob::class,
            'data' => [
                'ospedali_riuniti' => [
                    'id' => 1,
                    'codice' => 'PRONTO SOCCORSO (DEA 2° LIVELLO)-OSPEDALI RIUNITI-FOGGIA',
                    'nome' => 'Foggia - Ospedali Riuniti',
                    'descrizione' => 'Azienda Ospedaliero-Universitaria Ospedali Riuniti di Foggia, sede di DEA di II livello.',
                    'adulti' => true,
                    'indirizzo' => 'Viale Luigi Pinto, 1, 71122 Foggia FG',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/ospedali-riuniti-foggia',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.4566387,15.5230631',
                    'coords' => [
                        'lat' => '41.4566387',
                        'lng' => '15.5230631',
                    ],
                    'data' => [],
                ],
                'cerignola' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso',
                    'nome' => 'Cerignola - Ospedale G. Tatarella',
                    'descrizione' => 'Presidio ospedaliero Giuseppe Tatarella di Cerignola, ASL Foggia.',
                    'adulti' => true,
                    'indirizzo' => 'Viale Arcangelo Murgolo, 71042 Cerignola FG',
                    'telefono' => '0885 419111',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-foggia',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.2721185,15.9185049',
                    'coords' => [
                        'lat' => '41.2721185',
                        'lng' => '15.9185049',
                    ],
                    'data' => [],
                ],
                'manfredonia' => [
                    'id' => 3,
                    'codice' => 'S.C. Medicina e Chirurgia D\'accettazione ed Urgenza',
                    'nome' => 'Manfredonia - Ospedale San Camillo De Lellis',
                    'descrizione' => 'Presidio ospedaliero San Camillo De Lellis di Manfredonia, ASL Foggia.',
                    'adulti' => true,
                    'indirizzo' => 'Via Isonzo, 1, 71043 Manfredonia FG',
                    'telefono' => '0884 510111',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-foggia',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.6333662,15.9189557',
                    'coords' => [
                        'lat' => '41.6333662',
                        'lng' => '15.9189557',
                    ],
                    'data' => [],
                ],
                'san_severo' => [
                    'id' => 4,
                    'codice' => 'Medicina e Chirurgia D’accettazione D’urgenza',
                    'nome' => 'San Severo - Ospedale Teresa Masselli Mascia',
                    'descrizione' => 'Presidio ospedaliero Teresa Masselli Mascia di San Severo, ASL Foggia.',
                    'adulti' => true,
                    'indirizzo' => 'Viale Due Giugno, 71016 San Severo FG',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-foggia',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.6903258,15.3851755',
                    'coords' => [
                        'lat' => '41.6903258',
                        'lng' => '15.3851755',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
