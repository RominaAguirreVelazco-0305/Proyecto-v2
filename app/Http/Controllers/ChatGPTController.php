<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class ChatGPTController extends Controller
{
    public function generateText(Request $request)
    {
        $client = new Client();

        // Leer el archivo JSON con los datos de las preguntas y respuestas
        if (Storage::exists('investments.json')) {
            $data = Storage::get('investments.json');
            $faqs = json_decode($data, true)['faq'];

            $userMessage = strtolower($request->input('message'));

            // Buscar una respuesta relevante en el archivo JSON
            foreach ($faqs as $faq) {
                if (strpos($userMessage, strtolower($faq['question'])) !== false) {
                    return response()->json(['response' => $faq['answer']]);
                }
            }
        }

        // Si no hay una respuesta en el JSON, usar ChatGPT
        $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'max_tokens' => 100,
            ],
        ]);

        $body = json_decode($response->getBody()->getContents(), true);
        $finalResponse = $body['choices'][0]['message']['content'];

        return response()->json(['response' => $finalResponse]);
    }
}
