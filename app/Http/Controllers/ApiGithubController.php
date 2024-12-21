<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

class ApiGithubController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $client = new Client();
            $response = $client->request('GET', 'https://api.github.com/repos/roberto-calabrese/prontosoccorso_api');
            $body = $response->getBody();
            $dati = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

            return response()->json([
                'status' => true,
                'stars' => $dati['stargazers_count']
            ]);

        } catch (GuzzleException $e) {
            \Log::error('Error in : '.self::class .' - '. $e->getMessage() . ' - line: ' . $e->getLine());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            \Log::error('Error in : '.self::class .' - '. $e->getMessage() . ' - line: ' . $e->getLine());
            return response()->json([
                'status' => false,
                'message' => 'Errore Server'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
