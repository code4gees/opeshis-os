<?php

namespace App\Services\Messaging;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AfricasTalkingDriver extends BaseDriver
{
    public function getName(): string
    {
        return "Africa's Talking";
    }

    public function send(string $to, string $message, array $options = []): array
    {
        $phone = $this->formatPhone($to);
        $username = $this->config['api_key']; // Usually 'sandbox' or actual username
        $apiKey = $this->config['api_secret'];
        $endpoint = $this->config['endpoint'] ?: "https://api.africastalking.com/version1/messaging";

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'apikey' => $apiKey
            ])->asForm()->post($endpoint, [
                'username' => $username,
                'to' => $phone,
                'message' => $message,
                'from' => $this->config['sender_id']
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $recipient = $data['SMSMessageData']['Recipients'][0] ?? null;
                
                if ($recipient && strtolower($recipient['status']) === 'success') {
                    return [
                        'success' => true,
                        'id' => $recipient['messageId'],
                        'error' => null
                    ];
                }
                
                return [
                    'success' => false,
                    'id' => null,
                    'error' => $recipient['status'] ?? 'Provider rejection'
                ];
            }

            return [
                'success' => false,
                'id' => null,
                'error' => $response->body()
            ];

        } catch (\Exception $e) {
            Log::error("Africa's Talking send failure: " . $e->getMessage());
            return [
                'success' => false,
                'id' => null,
                'error' => $e->getMessage()
            ];
        }
    }
}
