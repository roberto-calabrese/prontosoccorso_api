<?php

namespace App\Http\Controllers;

use App\Jobs\Palermo\ArsCivicoJob;
use App\Jobs\Palermo\OspedaliRiunitiJob;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ApiPalermoController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {

        try {
            //SYNC METHOD
            $ospedaliRiuniti = Cache::remember('palermo.ospedali_riuniti_data', now()->addMinutes(config('palermo.ospedaliRiuniti.ttl')), static function () {
                return (new OspedaliRiunitiJob())->handle();
            });

            $arsCivico = Cache::remember('palermo.ars_civico_data', now()->addMinutes(config('palermo.arsCivico.ttl')), static function () {
                return (new ArsCivicoJob())->handle();
            });

            return response()->json([
                'status' => true,
                'data' => [
                    $ospedaliRiuniti,
                    $arsCivico
                ]
            ]);

        } catch (GuzzleException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
