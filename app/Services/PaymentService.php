<?php

namespace App\Services;

use App\Models\PaymentProvider;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    /**
     * Resolve Institutional Payment Gateway
     */
    public function getGateway(string $providerId)
    {
        $provider = PaymentProvider::find($providerId);
        
        if (!$provider || $provider->status !== 'active') {
            Log::error("Institutional payment gateway requested but not available: {$providerId}");
            return null;
        }

        // Logic to instantiate specific gateway drivers (e.g. Stripe, Flutterwave)
        return $provider;
    }
}
