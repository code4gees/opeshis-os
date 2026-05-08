<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\ReferralOutbound;

class AuthorizeCounterReferralAction
{
    public function execute(string $id, array $data): void
    {
        ReferralOutbound::findOrFail($id)->update([
            'counter_referral' => $data['notes'],
            'status' => 'counter_referred',
        ]);
    }
}
