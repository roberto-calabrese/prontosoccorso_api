<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\LeggeCoordinate;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRegioniController extends Controller
{
    use LeggeCoordinate;

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $regioni = config('regioni');

            $numeroOspedaliTotali = 0;

            $ospedaliPerRegione = array_map(function ($province, $regione) use (&$numeroOspedaliTotali) {
                $numeroOspedali = array_sum(array_map(static function ($provincia) {
                    return array_sum(array_map(static function ($ospedali) {
                        return count($ospedali['data']);
                    }, $provincia['ospedali']));
                }, $province));

                $numeroOspedaliTotali += $numeroOspedali;

                return [
                    'nome' => $regione,
                    'numero_ospedali' => $numeroOspedali,
                    // baricentro dei presidi: disegna la cartina di sfondo dell'hero in home
                    'coords' => $this->baricentro($this->puntiRegione($province)),
                ];
            }, $regioni, array_keys($regioni));

            return response()->json([
                'status' => true,
                'regioni' => $ospedaliPerRegione,
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
