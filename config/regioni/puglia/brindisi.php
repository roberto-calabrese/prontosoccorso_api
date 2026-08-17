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
    "{$ns}_provincia" => '160106',
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
        'slug' => 'brindisi',
        'Titolo' => 'Brindisi'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'puglia.brindisi',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola chiamata restituisce tutti i PS della provincia: il campo
        // 'codice' contiene il titolo con cui il portale pubblica la card.
        'pugliaSaluteBrindisi' => [
            'cache' => [
                'key' => 'puglia.brindisi',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'jobClass' => \App\Jobs\Puglia\PugliaSaluteScrapeJob::class,
            'data' => [
                'brindisi' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso Ospedale "A. Perrino"- Brindisi',
                    'nome' => 'Brindisi - Ospedale Antonio Perrino',
                    'descrizione' => 'Presidio ospedaliero Antonio Perrino, ospedale di riferimento della provincia di Brindisi.',
                    'adulti' => true,
                    'indirizzo' => 'Strada Statale 7 per Mesagne, 72100 Brindisi BR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-brindisi',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.6244003,17.9130960',
                    'coords' => [
                        'lat' => '40.6244003',
                        'lng' => '17.9130960',
                    ],
                    'data' => [],
                ],
                'francavilla_fontana' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Ospedale "D. Camberlingo"- Francavilla Fontana',
                    'nome' => 'Francavilla Fontana - Ospedale Dario Camberlingo',
                    'descrizione' => 'Presidio ospedaliero Dario Camberlingo di Francavilla Fontana, ASL Brindisi.',
                    'adulti' => true,
                    'indirizzo' => 'Via Ceglie, 72021 Francavilla Fontana BR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-brindisi',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.5394781,17.5774067',
                    'coords' => [
                        'lat' => '40.5394781',
                        'lng' => '17.5774067',
                    ],
                    'data' => [],
                ],
                'ostuni' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso Ospedale - Ostuni',
                    'nome' => 'Ostuni - Ospedale Civile',
                    'descrizione' => 'Ospedale civile di Ostuni, ASL Brindisi.',
                    'adulti' => true,
                    'indirizzo' => 'Via Villafranca, 72017 Ostuni BR',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-brindisi',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.7257110,17.5737099',
                    'coords' => [
                        'lat' => '40.7257110',
                        'lng' => '17.5737099',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
