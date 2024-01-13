<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiRegioniController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $regioni = config('regioni');

            $ospedaliPerRegione = array_map(static function ($province, $regione) {
                $numeroOspedali = array_sum(array_map(static function ($provincia) {
                    return array_sum(array_map(static function ($ospedali) {
                        return count($ospedali['data']);
                    }, $provincia['ospedali']));
                }, $province));

                return [
                    'nome' => $regione,
                    'numero_ospedali' => $numeroOspedali,
                ];
            }, $regioni, array_keys($regioni));

            return response()->json([
                'status' => true,
                'regioni' => $ospedaliPerRegione
            ]);


        } catch (Exception $e) {
            // Log dell'errore
            \Log::error('Error in ApiRegioniController: ' . $e->getMessage() . ' - line: ' . $e->getLine());

            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
