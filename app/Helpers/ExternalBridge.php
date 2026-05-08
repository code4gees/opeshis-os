<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExternalBridge
{
    /**
     * Transmit Aggregate Data to DHIS2
     */
    public static function pushToDHIS2($period, $dataValues)
    {
        $config = config('services.dhis2');
        if (!$config['enabled']) {
            Log::info("DHIS2 Export Simulation: " . json_encode($dataValues));
            return true;
        }

        $response = Http::withBasicAuth($config['user'], $config['pass'])
            ->post($config['url'] . '/api/dataValueSets', [
                'orgUnit' => $config['org_unit'],
                'period' => $period,
                'dataValues' => $dataValues
            ]);

        return $response->successful();
    }

    /**
     * Submit Electronic Claim to Insurance Provider
     */
    public static function submitClaim($claimData)
    {
        // Integration with National Insurance Portal / Private Gateways
        Log::info("Electronic Claim Submission Initiated: " . $claimData['invoice_id']);
        
        // Mocking external API response
        return [
            'status' => 'submitted',
            'claim_reference' => 'CLM-' . strtoupper(bin2hex(random_bytes(4))),
            'estimated_settlement_date' => now()->addDays(14)->toDateString()
        ];
    }

    /**
     * Generate Telemedicine Room
     */
    public static function createVideoRoom($appointmentId)
    {
        // Integration with Agora / Jitsi / Zoom
        return "https://meet.opeshis.os/room/" . $appointmentId . "?token=" . bin2hex(random_bytes(16));
    }
}
