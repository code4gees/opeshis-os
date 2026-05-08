<?php

namespace App\Services;

use App\Contracts\MessagingDriver;
use App\Services\Messaging\TwilioDriver;
use App\Services\Messaging\AfricasTalkingDriver;
use App\Services\Messaging\MTNCmDriver;
use App\Models\MessagingProvider;
use Illuminate\Support\Facades\Log;

class MessagingService
{
    /**
     * Resolve the driver instance based on provider ID
     */
    public function getDriver(string $providerId): ?MessagingDriver
    {
        $provider = MessagingProvider::find($providerId);
        
        if (!$provider) return null;

        $config = [
            'api_key' => $provider->api_key,
            'api_secret' => $provider->api_secret ?? '',
            'sender_id' => $provider->sender_id ?? 'OPESHIS',
            'endpoint' => $provider->endpoint ?? '',
            'id' => $provider->id
        ];

        switch (strtolower($provider->display_name)) {
            case 'twilio':
                return new TwilioDriver($config);
            case 'africa\'s talking':
                return new AfricasTalkingDriver($config);
            case 'mtn cameroon':
                return new MTNCmDriver($config);
            default:
                Log::warning("No driver found for provider: {$provider->display_name}");
                return null;
        }
    }

    /**
     * Dispatch a message using a specific provider
     */
    public function send(string $providerId, string $to, string $message, array $options = []): array
    {
        $driver = $this->getDriver($providerId);
        
        if (!$driver) {
            return ['success' => false, 'error' => 'Unsupported provider configuration'];
        }

        return $driver->send($to, $message, $options);
    }
}
