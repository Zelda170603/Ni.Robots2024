<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        try {
            $message = $request->input('message');
            
            // Your chatbot logic here
            $response = $this->processMessage($message);
            
            return response()->json([
                'response' => $response,
                'status' => 'success'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    private function processMessage(string $message): string
    {
        // Your chatbot processing logic
        return "You said: " . $message;
    }
}
