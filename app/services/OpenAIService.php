<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('OPENAI_API_KEY'); // Asegúrate de agregar esta clave en tu .env
    }

    public function obtenerConsejosSalud($historiaClinica, $formularioPaciente)
    {
        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "A continuación se te proporcionará la historia clínica del paciente y las respuestas de su formulario. Con esta información, genera recomendaciones de salud personalizadas.\n\nHistoria clínica: $historiaClinica\nFormulario: $formularioPaciente",
                    ],
                ],
                'max_tokens' => 500,
            ],
        ]);
        
        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['message']['content']; // Cambiar para acceder a 'content' de la respuesta
    }
}
