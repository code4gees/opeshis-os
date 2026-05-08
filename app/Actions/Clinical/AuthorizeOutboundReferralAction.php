<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\ReferralOutbound;
use App\Helpers\Opeshis;

class AuthorizeOutboundReferralAction
{
    /**
     * Authorize Institutional Outbound Referral Protocol
     */
    public function execute(array $data): ReferralOutbound
    {
        $referral = ReferralOutbound::create([
            'patient_id' => $data['patient_id'],
            'facility_name' => $data['facility'],
            'reason' => $data['reason'],
            'urgency' => $data['urgency'],
            'status' => 'pending',
            'referred_by' => auth()->id(),
        ]);

        Opeshis::logAction('REFERRAL_OUT', 'referrals_outbound', $referral->id, "Target: {$data['facility']}");

        return $referral;
    }
}
