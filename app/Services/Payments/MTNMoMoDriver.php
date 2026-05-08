<?php

namespace App\Services\Payments;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class MTNMoMoDriver extends BasePaymentDriver
{
    public function getName(): string
    {
        return 'MTN MoMo';
    }

    private function getAccessToken(): ?string
    {
        $cacheKey = "momo_token_" . $this->config['id'];
        
        return Cache::remember($cacheKey, 3500, function () {
            $baseUrl = $this->config['environment'] === 'sandbox' 
                ? 'https://sandbox.momodeveloper.mtn.com' 
                : 'https://proxy.momoapi.mtn.com';

            $response = Http::withHeaders([
                'Ocp-Apim-Subscription-Key' => $this->config['subscription_key'],
                'Authorization' => 'Basic ' . base64_encode($this->config['api_user'] . ':' . $this->config['api_key'])
            ])->post($baseUrl . '/collection/token/');

            return $response->json()['access_token'] ?? null;
        });
    }

    public function requestPayment(float $amount, string $phone, string $reference, array $options = []): array
    {
        $token = $this->getAccessToken();
        if (!$token) return ['success' => false, 'error' => 'Authentication Failure'];

        $externalId = (string) Str::uuid();
        $phone = $this->formatPhone($phone);
        
        $baseUrl = $this->config['environment'] === 'sandbox' 
            ? 'https://sandbox.momodeveloper.mtn.com' 
            : 'https://proxy.momoapi.mtn.com';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'X-Reference-Id' => $externalId,
                'X-Target-Environment' => $this->config['environment'],
                'Ocp-Apim-Subscription-Key' => $this->config['subscription_key'],
                'Content-Type' => 'application/json'
            ])->post($baseUrl . '/collection/v1_0/requesttopay', [
                'amount' => (string) $amount,
                'currency' => $this->config['currency'] ?? 'XAF',
                'externalId' => $reference,
                'payer' => [
                    'partyIdType' => 'MSISDN',
                    'partyId' => $phone
                ],
                'payerMessage' => $options['message'] ?? 'Opeshis Medical Payment',
                'payeeNote' => 'Opeshis OS'
            ]);

            if ($response->status() === 202) {
                return [
                    'success' => true,
                    'external_id' => $externalId,
                    'error' => null
                ];
            }

            return [
                'success' => false,
                'error' => $response->json()['message'] ?? 'MTN MoMo Error ' . $response->status()
            ];

        } catch (\Exception $e) {
            Log::error("MTN MoMo Request failure: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function checkStatus(string $externalId): array
    {
        $token = $this->getAccessToken();
        if (!$token) return ['status' => 'FAILED', 'error' => 'Auth Error'];

        $baseUrl = $this->config['environment'] === 'sandbox' 
            ? 'https://sandbox.momodeveloper.mtn.com' 
            : 'https://proxy.momoapi.mtn.com';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'X-Target-Environment' => $this->config['environment'],
            'Ocp-Apim-Subscription-Key' => $this->config['subscription_key']
        ])->get($baseUrl . "/collection/v1_0/requesttopay/{$externalId}");

        return $response->json();
    }
}
