<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sicilia' => [
        'provincie' => [
            'palermo' => \App\Services\GenericDataService::class,
            'messina' => \App\Services\GenericDataService::class,
            'agrigento' => \App\Services\GenericDataService::class,
            'catania' => \App\Services\GenericDataService::class,
            'siracusa' => \App\Services\GenericDataService::class,
        ],
    ],
    'liguria' => [
        'provincie' => [
            'imperia' => \App\Services\GenericDataService::class,
            'savona' => \App\Services\GenericDataService::class,
            'genova' => \App\Services\GenericDataService::class,
            'la-spezia' => \App\Services\GenericDataService::class,
        ],
    ],
    'veneto' => [
        'provincie' => [
            'belluno' => \App\Services\GenericDataService::class,
            'padova' => \App\Services\GenericDataService::class,
            'rovigo' => \App\Services\GenericDataService::class,
            'treviso' => \App\Services\GenericDataService::class,
            'venezia' => \App\Services\GenericDataService::class,
            'verona' => \App\Services\GenericDataService::class,
            'vicenza' => \App\Services\GenericDataService::class,
        ],
    ],
];
