<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function handleChatRequest(Request $request)
    {
        // Verifica que el mensaje del usuario esté presente
        $userMessage = $request->input('message');
        if (!$userMessage) {
            return response()->json(['error' => 'Mensaje vacío'], 400);
        }

        // Mensaje del sistema con contexto sobre el proyecto Ni.Robots
        $systemMessage = "Eres un asistente útil que ayuda a las personas con discapacidades físicas en Nicaragua. 
                      El proyecto Ni.Robots se centra en proporcionar acceso a servicios médicos, productos especializados, 
                      educación sobre condiciones médicas, y comunicación con profesionales de la salud. 
                      Por favor, proporciona respuestas relevantes y útiles basadas en esta información.";

        // Llama a la API de OpenAI
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer sk-Ksnue15rw3zDQ-T6QofZJxxvbtuHeV3PfZATYQEptvT3BlbkFJrMSB9hqdYi5lR9bcO-zyJ7qFEA0Bo06Z4HMVf-6OMA',
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'davinci-002',
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'max_tokens' => 70,
                'temperature' => 0.7,
            ]);

            // Verifica si la respuesta fue exitosa
            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'reply' => $data['choices'][0]['message']['content']
                ]);
            }

            // Manejo de errores en la respuesta de OpenAI
            $errorData = $response->json();
            $errorMessage = isset($errorData['error']['message']) ? $errorData['error']['message'] : 'Error al procesar la solicitud de OpenAI';

            // Manejo específico para la cuota excedida
            if (strpos($errorMessage, 'exceeded your current quota') !== false) {
                return response()->json([
                    'error' => 'Has excedido tu cuota de uso. Por favor, revisa tu plan y considera actualizarlo si es necesario.'
                ], 429); // 429 Too Many Requests
            }

            return response()->json(['error' => $errorMessage], 500);
        } catch (\Exception $e) {
            // Manejo de excepciones de conexión o problemas de red
            return response()->json(['error' => 'Error al conectarse con OpenAI: ' . $e->getMessage()], 500);
        }
    }
}
