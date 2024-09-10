<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class AnthropicService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.anthropic.com/v1/',
            'headers' => [
                'Content-Type' => 'application/json',
                'X-API-Key' => env('ANTHROPIC_API_KEY'),
                'anthropic-version' => '2023-06-01',
            ],
        ]);
    }

    public function generateResponse($prompt)
    {
        try {
            $response = $this->client->post('messages', [
                'json' => [
                    'model' => 'claude-3-sonnet-20240229',
                    'max_tokens' => 1000,
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt]
                    ]
                ]
            ]);

            $body = json_decode($response->getBody(), true);

            Log::info('Body response', ['body' => $body]);
            return $body['content'][0]['text'];
        } catch (GuzzleException $e) {
            Log::error('Error generating response', ['error' => $e->getMessage()]);
            return "Error: " . $e->getMessage();
        }
    }
}