<?php

namespace App\Services\Messaging;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TwilioDriver extends BaseDriver
{
    public function getName(): string
    {
        return 'Twilio';
    }

    public function send(string $to, string $message, array $options = []): array
    {
        $phone = $this->formatPhone($to);
        
        if (($options['channel'] ?? 'sms') === 'whatsapp') {
            $phone = 'whatsapp:' . $phone;
        }

        $sid = $this->config['api_key'];
        $token = $this->config['api_secret'];
        $from = $this->config['sender_id'];
        $endpoint = $this->config['endpoint'] ?: "https://api.twilio.com/2010-04-01/Accounts/{$sid}/Messages.json";

        try {
            $response = Http::asForm()
                ->withBasicAuth($sid, $token)
                ->post($endpoint, [
                    'To' => $phone,
                    'From' => $from,
                    'Body' => $message
                ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'id' => $response->json()['sid'],
                    'error' => null
                ];
            }

            return [
                'success' => false,
                'id' => null,
                'error' => $response->json()['message'] ?? 'Twilio API Error'
            ];

        } catch (\Exception $e) {
            Log::error("Twilio send failure: " . $e->getMessage());
            return [
                'success' => false,
                'id' => null,
                'error' => $e->getMessage()
            ];
        }
    }
}
