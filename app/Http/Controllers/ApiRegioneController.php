<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRegioneController extends Controller
{
    public function __invoke(Request $request, $regione): JsonResponse
    {
        try {
            $regioni = config('regioni');

            if (!array_key_exists($regione, $regioni)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Regione non trovata'
                ], Response::HTTP_NOT_FOUND);
            }

            $regioneData = $regioni[$regione];
            $numeroOspedaliTotali = 0;

            $result = array_map(static function ($provincia) use (&$numeroOspedaliTotali) {
                $numeroOspedali = array_sum(array_map(static function ($ospedali) {
                    return count($ospedali['data']);
                }, $provincia['ospedali']));

                $numeroOspedaliTotali += $numeroOspedali;

                return [
                    'numero_ospedali' => $numeroOspedali,
                    'meta' => $provincia['meta']
                ];


            }, $regioneData);

            return response()->json([
                'status' => true,
                'regione' => $regione,
                'provincie' => $result,
                'ospedaliTotali' => $numeroOspedaliTotali,
            ]);


        } catch (Exception $e) {
            // Log dell'errore
            \Log::error('Error in ApiRegioneController: ' . $e->getMessage() . ' - line: ' . $e->getLine());

            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
