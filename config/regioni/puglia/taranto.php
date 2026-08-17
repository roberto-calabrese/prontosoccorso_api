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
    "{$ns}_provincia" => '160112',
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
        'slug' => 'taranto',
        'Titolo' => 'Taranto'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'puglia.taranto',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola chiamata restituisce tutti i PS della provincia: il campo
        // 'codice' contiene il titolo con cui il portale pubblica la card.
        'pugliaSaluteTaranto' => [
            'cache' => [
                'key' => 'puglia.taranto',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'jobClass' => \App\Jobs\Puglia\PugliaSaluteScrapeJob::class,
            'data' => [
                'taranto' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso C/o Ospedale SS. Annunziata',
                    'nome' => 'Taranto - Ospedale SS. Annunziata',
                    'descrizione' => 'Presidio ospedaliero Santissima Annunziata, ospedale di riferimento della provincia di Taranto.',
                    'adulti' => true,
                    'indirizzo' => 'Via Francesco Bruno, 1, 74123 Taranto TA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-taranto',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.4644182,17.2484741',
                    'coords' => [
                        'lat' => '40.4644182',
                        'lng' => '17.2484741',
                    ],
                    'data' => [],
                ],
                'castellaneta' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso Ospedale di Castellaneta',
                    'nome' => 'Castellaneta - Ospedale di Castellaneta',
                    'descrizione' => 'Presidio ospedaliero di Castellaneta, ASL Taranto.',
                    'adulti' => true,
                    'indirizzo' => 'Via Ospedale, 74011 Castellaneta TA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-taranto',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.6314364,16.9346876',
                    'coords' => [
                        'lat' => '40.6314364',
                        'lng' => '16.9346876',
                    ],
                    'data' => [],
                ],
                'manduria' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso C/o Ospedale M. Giannuzzi',
                    'nome' => 'Manduria - Ospedale Marianna Giannuzzi',
                    'descrizione' => 'Presidio ospedaliero Marianna Giannuzzi di Manduria, ASL Taranto.',
                    'adulti' => true,
                    'indirizzo' => 'Via Mandonion, 74024 Manduria TA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-taranto',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.4026908,17.6398837',
                    'coords' => [
                        'lat' => '40.4026908',
                        'lng' => '17.6398837',
                    ],
                    'data' => [],
                ],
                'martina_franca' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso C/o Ospedale di Martina Franca',
                    'nome' => 'Martina Franca - Ospedale Valle d\'Itria',
                    'descrizione' => 'Presidio ospedaliero Valle d\'Itria di Martina Franca, ASL Taranto.',
                    'adulti' => true,
                    'indirizzo' => 'Via Irene del Vecchio, 74015 Martina Franca TA',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-taranto',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.7058152,17.3437578',
                    'coords' => [
                        'lat' => '40.7058152',
                        'lng' => '17.3437578',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
