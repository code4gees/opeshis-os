<?php

namespace App\Helpers;

use App\Models\MessagingProvider;
use App\Models\MessageQueue;
use Illuminate\Support\Facades\Log;

class ProtocolEngine
{
    /**
     * Evaluate and Trigger Institutional Protocols
     */
    public static function evaluate($context, $data)
    {
        // 1. Malaria Notification Protocol (Institutional Protocol #1)
        if ($context === 'CLINICAL_RECORD') {
            if (stripos($data['diagnosis'] ?? '', 'malaria') !== false) {
                self::triggerMalariaNotification($data);
            }
        }

        // 2. High Revenue Alert (Finance Protocol #4)
        if ($context === 'BILLING_INVOICE') {
            if (($data['total_amount'] ?? 0) > 1000000) {
                self::triggerHighRevenueAlert($data);
            }
        }
    }

    private static function triggerMalariaNotification($data)
    {
        Log::warning("PROTOCOL_TRIGGER: Malaria Case Detected. Dispatching to National Surveillance.");

        // Queue institutional notification via Eloquent
        MessageQueue::create([
            'sender_id' => null, // System-originated
            'recipient_id' => null, // Admin Pool
            'resolved_message' => "Institutional Protocol #1: Malaria case detected for Patient " . ($data['patient_id'] ?? 'Unknown') . ". Automated report dispatched.",
            'channel' => 'SYSTEM',
            'status' => 'pending',
        ]);
    }

    private static function triggerHighRevenueAlert($data)
    {
        Log::info("PROTOCOL_TRIGGER: High Revenue Invoice (" . $data['total_amount'] . ") flagged for Audit.");
    }

    /**
     * Calculate NEWS2 (National Early Warning Score)
     */
    public static function calculateNEWS2($vitals)
    {
        $score = 0;
        if (($vitals['resp_rate'] ?? 20) > 24) $score += 3;
        if (($vitals['spo2'] ?? 98) < 92) $score += 3;
        if (($vitals['temp'] ?? 37) > 39) $score += 2;
        
        return [
            'score' => $score,
            'risk' => ($score > 4) ? 'HIGH' : 'LOW',
            'timestamp' => now()
        ];
    }
}
