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
            $ospedaliPerRegione = [];

            foreach ($regioni as $regione => $province) {
                $numeroOspedali = 0;

                // Itera su ogni provincia (che rappresenta un ospedale) e incrementa il conteggio
                foreach ($province as $provincia) {
                    $numeroOspedali += count($provincia['ospedali']);
                }

                $ospedaliPerRegione[$regione] = [
                    'numero_ospedali' => $numeroOspedali,
                ];
            }

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
