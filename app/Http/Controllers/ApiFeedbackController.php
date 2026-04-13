<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\FeedbackSubmitted;

class ApiFeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'cf-turnstile-response' => 'required|string',
        ]);

        $secret = config('services.turnstile.secret_key');
        $token = $request->input('cf-turnstile-response');
        $remoteip = $request->ip();

        // Validate Turnstile
        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => $secret,
            'response' => $token,
            'remoteip' => $remoteip,
        ]);

        $result = $response->json();

        if (!$response->successful() || !isset($result['success']) || !$result['success']) {
            Log::error('Turnstile validation failed', ['response' => $result]);
            return response()->json([
                'success' => false,
                'message' => 'Validazione captcha fallita. Riprova.'
            ], 400);
        }

        try {
            // Send email
            $toEmail = config('services.feedback.email');
            Mail::to($toEmail)->send(new FeedbackSubmitted($request->name, $request->message));
        } catch (\Exception $e) {
            Log::error('Errore durante l\'invio dell\'email di feedback', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Si è verificato un errore durante l\'invio del feedback.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Feedback inviato con successo!'
        ]);
    }
}
