<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'api' middleware group. Make something great!
|
*/

//TODO Creare una route API che esegue il dispatch dei job per lo scraping (ASYNC)
//TODO Il Jon applica la logica di cache (se esiste in cache lo prendo, se non c'è lo prendo e lo mantengo per X minuti)
//TODO aggiungere evento EMIT (websocket) usando pusher per aggiornare i dati lato client (logica chi arriva arriva).

Route::get('buccheri', static function (){
    $config = config('regioni.sicilia.palermo.ospedali.buccheri');
    $test = (new \App\Jobs\GenericAJaxJob(false, $config))->handle();
    dd($test);
});


Route::get('/settings', \App\Http\Controllers\ApiSettingsController::class);

Route::get('/regioni', \App\Http\Controllers\ApiRegioniController::class);
Route::get('/{regione}', \App\Http\Controllers\ApiRegioneController::class);


Route::get('/{regione}/{provincia}', \App\Http\Controllers\ApiProvinciaController::class);

//Route::get('/sicilia/palermo', \App\Http\Controllers\Sicilia\ApiPalermoController::class);




