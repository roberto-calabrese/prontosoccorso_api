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
    "{$ns}_provincia" => '160113',
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
        'slug' => 'barletta-andria-trani',
        'Titolo' => 'Barletta Andria Trani'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'puglia.barletta-andria-trani',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola chiamata restituisce tutti i PS della provincia: il campo
        // 'codice' contiene il titolo con cui il portale pubblica la card.
        'pugliaSaluteBat' => [
            'cache' => [
                'key' => 'puglia.barletta-andria-trani',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'jobClass' => \App\Jobs\Puglia\PugliaSaluteScrapeJob::class,
            'data' => [
                'andria' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso C/o Ospedale "L. Bonomo"',
                    'nome' => 'Andria - Ospedale Lorenzo Bonomo',
                    'descrizione' => 'Presidio ospedaliero Lorenzo Bonomo di Andria, ASL Barletta-Andria-Trani.',
                    'adulti' => true,
                    'indirizzo' => 'Via Ventiquattro Maggio, 76123 Andria BT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-bt',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.2293454,16.3034776',
                    'coords' => [
                        'lat' => '41.2293454',
                        'lng' => '16.3034776',
                    ],
                    'data' => [],
                ],
                'barletta' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso C/o Ospedale "Mons. A. R. Dimiccoli"',
                    'nome' => 'Barletta - Ospedale Monsignor Dimiccoli',
                    'descrizione' => 'Presidio ospedaliero Monsignor Raffaele Dimiccoli di Barletta, ASL Barletta-Andria-Trani.',
                    'adulti' => true,
                    'indirizzo' => 'Viale Ippocrate, 15, 76121 Barletta BT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-bt',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.3137129,16.2536782',
                    'coords' => [
                        'lat' => '41.3137129',
                        'lng' => '16.2536782',
                    ],
                    'data' => [],
                ],
                'bisceglie' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso C/o Ospedale "Vittorio Emanuele II"',
                    'nome' => 'Bisceglie - Ospedale Vittorio Emanuele II',
                    'descrizione' => 'Presidio ospedaliero Vittorio Emanuele II di Bisceglie, ASL Barletta-Andria-Trani.',
                    'adulti' => true,
                    'indirizzo' => 'Via Giacinto Nigri, 76011 Bisceglie BT',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-bt',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=41.2425845,16.4886539',
                    'coords' => [
                        'lat' => '41.2425845',
                        'lng' => '16.4886539',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
