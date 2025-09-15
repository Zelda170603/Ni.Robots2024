<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function handleChatRequest(Request $request)
    {
        $userMessage = $request->input('message');
        if (!$userMessage) {
            return response()->json(['error' => 'Mensaje vacío'], 400);
        }

        $systemMessage = "Eres un asistente útil que ayuda a las personas con discapacidades físicas en Nicaragua.
        El proyecto Ni.Robots se centra en proporcionar acceso a servicios médicos, productos especializados,
        educación sobre condiciones médicas, y comunicación con profesionales de la salud.
        Proporciona respuestas relevantes y útiles basadas en esta información.";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo', // ✅ modelo válido
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'max_tokens' => 200,
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'reply' => $data['choices'][0]['message']['content'] ?? "No hubo respuesta."
                ]);
            }

            $errorData = $response->json();
            return response()->json([
                'error' => $errorData['error']['message'] ?? 'Error desconocido en OpenAI'
            ], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al conectarse con OpenAI: ' . $e->getMessage()], 500);
        }
    }
}
