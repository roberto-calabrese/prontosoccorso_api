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

// I dati sono in una tabella statica della pagina: righe "In attesa", "In visita"
// e "Totale", una colonna per codice di priorita' da 1 a 5.
//
// Il combinatore di figlio diretto serve a isolare la tabella giusta: nella
// pagina ce n'e' un'altra con la stessa classe (il riquadro con le icone dei
// codici), che sta invece dentro un div.table-responsive.
$tabella = 'div.container > table.table tbody';

// Codici di priorita' della Toscana: 1 emergenza ... 5 non urgenza.
$codici = [
    'rosso' => 1,
    'arancione' => 2,
    'azzurro' => 3,
    'verde' => 4,
    'bianco' => 5,
];

$righe = [
    'in_attesa' => 1,
    'in_visita' => 2,
    'totale' => 3,
];

$datiProntoSoccorso = static function () use ($tabella, $codici, $righe): array {

    $cella = static fn(int $riga, int $codice): string =>
        "$tabella tr:nth-child($riga) td:nth-child(" . ($codice + 1) . ")"; // la prima cella della riga e' un <th>

    $data = [];

    foreach ($codici as $colore => $codice) {
        $data[$colore] = [
            'selector' => $cella($righe['in_attesa'], $codice),
            'extra' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'selector' => $cella($righe['in_attesa'], $codice),
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in visita',
                    'selector' => $cella($righe['in_visita'], $codice),
                ],
                'totale_presenti' => [
                    'label' => 'Totale presenti',
                    'selector' => $cella($righe['totale'], $codice),
                ],
            ]
        ];
    }

    $data['totali'] = [
        'action' => [
            'operation' => 'sum',
            'keys' => [
                'in_attesa' => [
                    'label' => 'Pazienti in attesa',
                    'value' => null
                ],
                'in_trattamento' => [
                    'label' => 'Pazienti in visita',
                    'value' => null
                ],
                'totale_presenti' => [
                    'label' => 'Totale presenti',
                    'value' => null
                ],
            ]
        ],
    ];

    // La pagina pubblica l'orario della rilevazione ("aggiornato alle HH:MM del gg/mm/aaaa").
    $data['extra'] = [
        'ultimo_aggiornamento' => [
            'label' => 'Rilevazione',
            'selector' => 'div.testolungo h6.text-center',
        ],
    ];

    return $data;
};

return [
    'meta' => [
        'slug' => 'siena',
        'Titolo' => 'Siena'
    ],
    'websocket' => [
        'active' => true,
        'channel' => 'toscana.siena',
        'event' => 'data'
    ],
    'tableSettings' => $tableSettings,
    'ospedali' => [
        'sienaAouSenese' => [
            'cache' => [
                'key' => 'toscana.siena.aouSenese',
                'ttlMinute' => 1
            ],
            'url' => 'https://www.ao-siena.toscana.it/pronto-soccorso/',
            'headers' => [
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language' => 'it-IT,it;q=0.9',
                'Referer' => 'https://www.ao-siena.toscana.it/',
                'User-Agent' => $userAgent,
            ],
            'jobClass' => \App\Jobs\GenericScrapeJob::class,
            'data' => [
                'aouSenese' => [
                    'id' => 1,
                    'nome' => 'Siena - Policlinico Santa Maria alle Scotte',
                    'descrizione' => 'Pronto soccorso dell\'Azienda ospedaliero-universitaria Senese, DEA di II livello di riferimento per l\'Area Vasta Toscana Sud Est.',
                    'adulti' => true,
                    'indirizzo' => 'Viale Mario Bracci, 16, 53100 Siena SI',
                    'telefono' => '0577 585111',
                    'email' => '',
                    'web' => 'https://www.ao-siena.toscana.it/pronto-soccorso/',
                    'google_maps' => 'https://www.google.com/maps/search/?api=1&query=43.3435671,11.3296733',
                    'coords' => [
                        'lat' => '43.3435671',
                        'lng' => '11.3296733',
                    ],
                    'data' => $datiProntoSoccorso(),
                ]
            ]
        ],
    ]
];
