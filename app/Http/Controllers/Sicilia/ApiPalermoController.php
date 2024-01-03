<?php

namespace App\Http\Controllers\Sicilia;

use App\Http\Controllers\Controller;
use App\Services\Sicilia\PalermoDataService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiPalermoController extends Controller
{
    protected PalermoDataService $palermoDataService;

    public function __construct(PalermoDataService $palermoDataService)
    {
        $this->palermoDataService = $palermoDataService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = $this->palermoDataService->getData();

            return response()->json([
                'status' => true,
                'loading' => $this->palermoDataService->getLoadingCount(),
                'websocket' => $this->palermoDataService->getWebSocketConfig(),
                'data' => $data,
            ]);

        } catch (Exception $e) {
            // Log dell'errore
            \Log::error('Error in ApiPalermoController: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
