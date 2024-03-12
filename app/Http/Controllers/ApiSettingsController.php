<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiSettingsController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $regioni = config('regioni');

            $ospedaliPerRegione = array_map(static function ($province, $regione) {
                $numeroOspedaliPerRegione = array_sum(array_map(static function ($provincia) {
                    return array_sum(array_map(static function ($ospedali) {
                        return count($ospedali['data']);
                    }, $provincia['ospedali']));
                }, $province));

                $numeroOspedaliPerProvince = array_map(static function ($provincia) {
                    $numeroOspedali = array_sum(array_map(static function ($ospedali) {
                        return count($ospedali['data']);
                    }, $provincia['ospedali']));

                    return [
                        'n_ospedali' => $numeroOspedali,
                        'meta' => $provincia['meta']
                    ];
                }, $province);

                return [
                    'regione' => ucfirst($regione),
                    'slug_regione' => $regione,
                    'n_ospedali' => $numeroOspedaliPerRegione,
                    'province' => $numeroOspedaliPerProvince
                ];
            }, $regioni, array_keys($regioni));

            return response()->json([
                'status' => true,
                'routes' => $ospedaliPerRegione
            ]);

        } catch (Exception $e) {
            // Log dell'errore
            \Log::error('Error in ApiInitController: ' . $e->getMessage() . ' - line: ' . $e->getLine());

            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
