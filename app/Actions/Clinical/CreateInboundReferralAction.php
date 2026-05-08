<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\ReferralInbound;
use Illuminate\Support\Facades\Auth;

class CreateInboundReferralAction
{
    public function execute(array $data): ReferralInbound
    {
        return ReferralInbound::create([
            'patient_name' => $data['patient_name'],
            'referring_facility' => $data['facility'],
            'reason' => $data['reason'],
            'received_by' => Auth::id(),
        ]);
    }
}
