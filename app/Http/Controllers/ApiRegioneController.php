<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\LeggeCoordinate;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRegioneController extends Controller
{
    use LeggeCoordinate;

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

            $result = array_map(function ($provincia) use (&$numeroOspedaliTotali) {
                $numeroOspedali = array_sum(array_map(static function ($ospedali) {
                    return count($ospedali['data']);
                }, $provincia['ospedali']));

                $numeroOspedaliTotali += $numeroOspedali;

                return [
                    'numero_ospedali' => $numeroOspedali,
                    'meta' => $provincia['meta'],
                    // baricentro dei presidi: disegna la cartina di sfondo dell'hero di regione
                    'coords' => $this->baricentro($this->puntiProvincia($provincia)),
                ];


            }, $regioneData);

            return response()->json([
                'status' => true,
                'regione' => $regione,
                'provincie' => $result,
                'ospedaliTotali' => $numeroOspedaliTotali,
            ]);


        } catch (Exception $e) {
            \Log::error('Error in : '.self::class .' - '. $e->getMessage() . ' - line: ' . $e->getLine());

            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
