<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class SendInstitutionalOtpAction
{
    /**
     * Generate and Dispatch Institutional OTP Matrix
     */
    public function execute(User $user): void
    {
        $otp = (string) rand(100000, 999999);
        
        $user->update([
            'two_factor_code' => $otp,
            'two_factor_expires_at' => now()->addMinutes(10),
        ]);

        // Institutional Payload: In production, this would trigger an SMS/Email provider.
        // For institutional development, we log it to the secure forensic trace.
        Log::info("Institutional OTP Dispatched. User: {$user->email}, Code: {$otp}");
        
        // TEMPORARY: Also store in session for the UI if needed for testing
        session(['last_otp_debug' => $otp]);
    }
}
