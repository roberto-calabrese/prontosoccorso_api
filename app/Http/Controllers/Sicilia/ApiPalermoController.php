<?php

namespace App\Http\Controllers\Sicilia;

use App\Http\Controllers\Controller;
use App\Jobs\Sicilia\Palermo\ArsCivicoJob;
use App\Jobs\Sicilia\Palermo\OspedaliRiunitiJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ApiPalermoController extends Controller
{
    /**
     * Gestisce le richieste API relative ai dati dei servizi sanitari nella regione di Palermo, Sicilia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Verifica se è attiva la modalità WebSocket
            $websocket = config('queue.default') === 'redis' && config('regioni.sicilia.palermo.websocket.active');

            // Recupera i dati degli Ospedali Riuniti dalla cache, se presenti
            $ospedaliRiunitiData = Cache::get(config('regioni.sicilia.palermo.data.ospedaliRiuniti.cache.key')) ?: [];

            // Recupera i dati dell'Ars Civico dalla cache, se presenti
            $arsCivicoData = Cache::get(config('regioni.sicilia.palermo.data.arsCivico.cache.key')) ?: [];

            // Se i dati degli Ospedali Riuniti non sono presenti in cache
            if (!$ospedaliRiunitiData) {
                // Esegue il job OspedaliRiunitiJob direttamente o tramite WebSocket
                $ospedaliRiunitiData = $websocket
                    ? dispatch(new OspedaliRiunitiJob(true))
                    : (new OspedaliRiunitiJob())->handle();

                // Se è attiva la modalità WebSocket, assegna un array vuoto ai dati degli Ospedali Riuniti
                $ospedaliRiunitiData = $websocket ? [] : $ospedaliRiunitiData;
            }

            // Se i dati dell'Ars Civico non sono presenti in cache
            if (!$arsCivicoData) {
                // Esegue il job ArsCivicoJob direttamente o tramite WebSocket
                $arsCivicoData = $websocket
                    ? dispatch(new ArsCivicoJob(true))
                    : (new ArsCivicoJob())->handle();

                // Se è attiva la modalità WebSocket, assegna un array vuoto ai dati dell'Ars Civico
                $arsCivicoData = $websocket ? [] : $arsCivicoData;
            }

            // Restituisce una risposta JSON contenente lo stato, l'indicatore di caricamento e i dati combinati degli Ospedali Riuniti e dell'Ars Civico
            return response()->json([
                'status' => true,
                'loading' => (count(config('regioni.sicilia.palermo.data.ospedaliRiuniti.data')) + count(config('regioni.sicilia.palermo.data.arsCivico.data'))),
                'websocket' => [
                    'active' => $websocket,
                    'channel' => config('regioni.sicilia.palermo.websocket.channel'),
                    'event' => config('regioni.sicilia.palermo.websocket.event'),
                ],
                // Merge array dei dati
                'data' => array_merge(
                    $ospedaliRiunitiData,
                    $arsCivicoData
                )
            ]);

        } catch (\Exception $e) {
            // Se si verifica un'eccezione, restituisce una risposta JSON con uno stato di errore e un messaggio di errore interno
            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
