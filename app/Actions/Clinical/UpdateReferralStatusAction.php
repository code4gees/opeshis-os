<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\ReferralOutbound;

class UpdateReferralStatusAction
{
    public function execute(string $id, array $data): void
    {
        ReferralOutbound::findOrFail($id)->update([
            'status' => $data['status'],
            'status_notes' => $data['notes'] ?? null,
        ]);
    }
}
