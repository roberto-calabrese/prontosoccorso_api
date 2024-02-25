<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiProvinciaController extends Controller
{
    public function __invoke(Request $request, $regione, $provincia): JsonResponse
    {
        try {
            $provinciaServiceClass = config("services.{$regione}.provincie.{$provincia}");

            if (!$provinciaServiceClass || !class_exists($provinciaServiceClass)) {
                return response()->json([
                    'status' => false,
                    'message' => "Servizio non valido per la regione {$regione} - provincia {$provincia}"
                ], Response::HTTP_NOT_FOUND);
            }

            $provinciaService = app($provinciaServiceClass);
            $data = $provinciaService->getData();
            $new_data = [];
            foreach ($data as $key => $item) {
                $new_data[] = [
                    'key' => $key,
                    ...$item
                ];
            }

            return response()->json([
                'status' => true,
                'websocket' => $provinciaService->getWebSocketConfig(),
                'data' => $new_data,
            ]);

        } catch (Exception $e) {
            // Log dell'errore
            \Log::error('Error in ApiProvinciaController: ' . $e->getMessage() . ' - line: '. $e->getLine());

            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
