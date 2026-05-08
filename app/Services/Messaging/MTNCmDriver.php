<?php

namespace App\Services\Messaging;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class MTNCmDriver extends BaseDriver
{
    public function getName(): string
    {
        return 'MTN Cameroon';
    }

    private function getAccessToken(): ?string
    {
        return Cache::remember('mtn_messaging_token', 3500, function () {
            $response = Http::withBasicAuth($this->config['api_key'], $this->config['api_secret'])
                ->asForm()
                ->post('https://api.mtn.cm/v1/oauth/token', [
                    'grant_type' => 'client_credentials'
                ]);

            return $response->json()['access_token'] ?? null;
        });
    }

    public function send(string $to, string $message, array $options = []): array
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return ['success' => false, 'id' => null, 'error' => 'Authentication Failure'];
        }

        $phone = str_replace('+', '', $this->formatPhone($to));
        $endpoint = $this->config['endpoint'] ?: "https://api.mtn.cm/v1/sms/send";

        try {
            $response = Http::withToken($token)
                ->post($endpoint, [
                    'to' => $phone,
                    'from' => $this->config['sender_id'],
                    'message' => $message
                ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'id' => $response->json()['id'] ?? 'mtn-ok',
                    'error' => null
                ];
            }

            return [
                'success' => false,
                'id' => null,
                'error' => $response->json()['message'] ?? 'MTN API Error'
            ];

        } catch (\Exception $e) {
            Log::error("MTN send failure: " . $e->getMessage());
            return [
                'success' => false,
                'id' => null,
                'error' => $e->getMessage()
            ];
        }
    }
}
