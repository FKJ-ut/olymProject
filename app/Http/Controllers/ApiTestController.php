<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;
// Use Laravel's HTTP client

class ApiTestController extends Controller
{
    public function testApi()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => '', //Insert API key here
            ])->get('https://api.openai.com/v1/chat/completions');

            // Check if request was successful
            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json(['error' => $response->body()], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function phpinfo()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => '', //Insert API key here
            ])->get('https://api.openai.com/v1/chat/completions');

            // Check if request was successful
            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json(['error' => $response->body()], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function test()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        ])->get('https://api.openai.com/v1/engines');

        return $response->json();
    }

    public function getEngines()
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => 'Hello!'],
            ],
        ]);

        if ($result->failed()) {
            return response()->json([
                'error' => $response->json(),
                'status' => $response->status(),
            ], $result->status());
        }

        return $result->json();
    }


}
