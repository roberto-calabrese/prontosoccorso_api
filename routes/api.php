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
Route::get('/settings', \App\Http\Controllers\ApiSettingsController::class);
Route::get('/github', \App\Http\Controllers\ApiGithubController::class);
Route::get('/regioni', \App\Http\Controllers\ApiRegioniController::class);
Route::get('/{regione}', \App\Http\Controllers\ApiRegioneController::class);
Route::get('/{regione}/{provincia}', \App\Http\Controllers\ApiProvinciaController::class);




