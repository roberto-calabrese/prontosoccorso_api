<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Timeout delle chiamate HTTP di scraping
    |--------------------------------------------------------------------------
    |
    | Guzzle di default attende all'infinito. Poiche' i job di tutte le province
    | condividono la stessa coda, una sorgente che smette di rispondere terrebbe
    | occupati i worker a tempo indeterminato bloccando lo scraping di TUTTE le
    | altre province (non solo della sua).
    |
    | I valori vanno tenuti sotto il timeout del worker Horizon (60s), cosi' e' il
    | job a fallire per conto suo: in questo modo scattano failed() e la notifica
    | di scrape fallito, invece di veder morire il processo worker.
    |
    */

    'connect_timeout' => (float) env('SCRAPE_CONNECT_TIMEOUT', 10),

    'timeout' => (float) env('SCRAPE_TIMEOUT', 25),

];
