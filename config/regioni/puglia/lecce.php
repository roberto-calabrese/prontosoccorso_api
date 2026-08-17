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
    "{$ns}_provincia" => '160116',
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
        'slug' => 'lecce',
        'Titolo' => 'Lecce'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'puglia.lecce',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        // Una sola chiamata restituisce tutti i PS della provincia: il campo
        // 'codice' contiene il titolo con cui il portale pubblica la card.
        'pugliaSaluteLecce' => [
            'cache' => [
                'key' => 'puglia.lecce',
                'ttlMinute' => 1
            ],
            'url' => $url,
            'headers' => $headers,
            'jobClass' => \App\Jobs\Puglia\PugliaSaluteScrapeJob::class,
            'data' => [
                'lecce' => [
                    'id' => 1,
                    'codice' => 'Pronto Soccorso  - P.O. Vito Fazzi - Lecce',
                    'nome' => 'Lecce - Ospedale Vito Fazzi',
                    'descrizione' => 'Presidio ospedaliero Vito Fazzi, ospedale di riferimento della provincia di Lecce.',
                    'adulti' => true,
                    'indirizzo' => 'Piazza Filippo Muratore, 1, 73100 Lecce LE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-lecce',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.3256515,18.1639792',
                    'coords' => [
                        'lat' => '40.3256515',
                        'lng' => '18.1639792',
                    ],
                    'data' => [],
                ],
                'casarano' => [
                    'id' => 2,
                    'codice' => 'Pronto Soccorso - P.O. F. Ferrari - Casarano',
                    'nome' => 'Casarano - Ospedale Francesco Ferrari',
                    'descrizione' => 'Presidio ospedaliero Francesco Ferrari di Casarano, ASL Lecce.',
                    'adulti' => true,
                    'indirizzo' => 'Via Giuseppe Giusti, 73042 Casarano LE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-lecce',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.0182180,18.1567650',
                    'coords' => [
                        'lat' => '40.0182180',
                        'lng' => '18.1567650',
                    ],
                    'data' => [],
                ],
                'copertino' => [
                    'id' => 3,
                    'codice' => 'Pronto Soccorso -P.O. S. Giuseppe da Copertino - Copertino',
                    'nome' => 'Copertino - Ospedale San Giuseppe da Copertino',
                    'descrizione' => 'Presidio ospedaliero San Giuseppe da Copertino, ASL Lecce.',
                    'adulti' => true,
                    'indirizzo' => 'Via Don Luigi Sturzo, 73043 Copertino LE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-lecce',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.2781306,18.0468952',
                    'coords' => [
                        'lat' => '40.2781306',
                        'lng' => '18.0468952',
                    ],
                    'data' => [],
                ],
                'galatina' => [
                    'id' => 4,
                    'codice' => 'Pronto Soccorso -P.O. S. Caterina Novella - Galatina',
                    'nome' => 'Galatina - Ospedale Santa Caterina Novella',
                    'descrizione' => 'Presidio ospedaliero Santa Caterina Novella di Galatina, ASL Lecce.',
                    'adulti' => true,
                    'indirizzo' => 'Via della Repubblica, 73013 Galatina LE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-lecce',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.1761373,18.1577903',
                    'coords' => [
                        'lat' => '40.1761373',
                        'lng' => '18.1577903',
                    ],
                    'data' => [],
                ],
                'gallipoli' => [
                    'id' => 5,
                    'codice' => 'Pronto Soccorso  - P.O. S. Cuore Di Gesù - Gallipoli',
                    'nome' => 'Gallipoli - Ospedale Sacro Cuore di Gesù',
                    'descrizione' => 'Presidio ospedaliero Sacro Cuore di Gesù di Gallipoli, ASL Lecce.',
                    'adulti' => true,
                    'indirizzo' => 'Via Nuova per Alezio, 73014 Gallipoli LE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-lecce',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.0564461,18.0151121',
                    'coords' => [
                        'lat' => '40.0564461',
                        'lng' => '18.0151121',
                    ],
                    'data' => [],
                ],
                'scorrano' => [
                    'id' => 6,
                    'codice' => 'Pronto Soccorso -P.O. Veris  Delli Ponti - Scorrano',
                    'nome' => 'Scorrano - Ospedale Veris Delli Ponti',
                    'descrizione' => 'Presidio ospedaliero Ignazio Veris Delli Ponti di Scorrano, ASL Lecce.',
                    'adulti' => true,
                    'indirizzo' => 'Via Malta, 73020 Scorrano LE',
                    'telefono' => '',
                    'email' => '',
                    'web' => 'https://www.sanita.puglia.it/web/asl-lecce',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=40.0941212,18.3020652',
                    'coords' => [
                        'lat' => '40.0941212',
                        'lng' => '18.3020652',
                    ],
                    'data' => [],
                ],
            ]
        ],
    ]
];
