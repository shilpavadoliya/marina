<?php

namespace App\Services;

use GuzzleHttp\Client;

class BrevoSmsService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.sendinblue.com/v3/',
            'headers' => [
                'api-key' => env('BREVO_API_KEY'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);

        $this->apiKey = env('BREVO_API_KEY');
    }

    public function sendSms($to, $message, $type = 'transactional')
    {
        $response = $this->client->post('transactionalSMS/sms', [
            'json' => [
                'sender' => 'MARINA',  // Replace with your sender name
                'recipient' => $to,
                'content' => $message,
                'type' => $type
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
