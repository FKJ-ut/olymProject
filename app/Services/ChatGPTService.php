<?php

namespace App\Services;

use GuzzleHttp\Client;

class ChatGPTService
{
    protected Client $client;
    protected string $apiKey;
    protected string $organization;

    public function __construct()
    {
        // Initialize Guzzle HTTP client and set it to disable SSL verification
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com',
            'verify' => false, // Disable SSL verification
        ]);

        // Get API Key and Organization ID from config
        $this->apiKey = config('services.openai.api_key');
        $this->organization = config('services.openai.organization');
    }

    public function categorizeComments(array $comments)
    {
        // Prepare the prompt for the OpenAI API
        $prompt = "You are a comment categorization assistant for an olympiad exam. Please group similar comments together and provide a short description for each category.\n\n";
        foreach ($comments as $comment) {
            $prompt .= "- $comment\n";
        }
        $prompt .= "\nPlease output the result in the following format:\n";
        $prompt .= "Category name:\n- Comment 1\n- Comment 2\nDescription: Brief description of this category.\nNumber: How many comments fall under this category.\n\n";
        $prompt .= "Category name:\n- Comment 1\n- Comment 2\nDescription: Brief description of this category.\nNumber: How many comments fall under this category.";
        $prompt .= "After all categories are listed, provide your own suggestion based on all the comments to improve the question. NOTE, there is only one question, there cannot be multiple questions for multiple people, so providing multiple questions in IMPOSSIBLE.";

        // Send the request to OpenAI API using Guzzle
        $response = $this->client->post('/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Organization' => $this->organization,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4o-mini', // or 'gpt-4', depending on your preference
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ],
        ]);

        // Get the response and decode it
        $result = json_decode($response->getBody()->getContents(), true);

        // Return the content from the response
        return $result['choices'][0]['message']['content'] ?? 'No response';
    }

    public function translate($text, $translation)
    {
        $prompt =  "You are a translation bot, translating the given text into" . $translation;
        $prompt .= "Only respond with the translation and nothing else.";
        $prompt .= "Translate the following into " . $translation . ":";
        $prompt .= $text;

        // Prepare the request for translation
        $response = $this->client->post('/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Organization' => $this->organization,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4o-mini', // Use the appropriate model version
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ],
        ]);
        // Extract and return the translated content

        // Extract and return the translated content
        $responseBody = json_decode($response->getBody()->getContents(), true);
        return $responseBody['choices'][0]['message']['content'] ?? 'No response';
    }

    public function compareTranslations($originalText, $originalTranslation, $newTranslation)
{
        // Construct the prompt for comparison
        $prompt = "You are a translation comparison bot. Your task is to compare the following original text with two translations: the original translation and the new translation.";
        $prompt .= " Provide comments and suggestions on how to improve the new translation based on the original text and the original translation.";
        $prompt .= " Focus on accuracy, fluency, and any significant differences between the original text and the two translations.";
        $prompt .= " DO NOT give a revised version, only suggestions and comments. Less than 3 paragraphs.";
        $prompt .= "\n\nOriginal Text:\n";
        $prompt .= $originalText;
        $prompt .= "\n\nOriginal Translation:\n";
        $prompt .= $originalTranslation;
        $prompt .= "\n\nNew Translation:\n";
        $prompt .= $newTranslation;
        $prompt .= "\n\nComments and Suggestions:";

        // Implement logic to get comparisons and suggestions
        // Example logic could be calling an API or using a text processing library
        $response = $this->client->post('/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Organization' => $this->organization,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-4o-mini', // Use the appropriate model version
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ],
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);
        return $responseBody['choices'][0]['message']['content'] ?? 'No response';
    }

}
