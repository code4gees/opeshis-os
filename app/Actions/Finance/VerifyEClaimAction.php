<?php

declare(strict_types=1);

namespace App\Actions\Finance;

use App\Models\EClaim;
use Illuminate\Support\Facades\Auth;

class VerifyEClaimAction
{
    public function execute(string $id, array $data): EClaim
    {
        $claim = EClaim::findOrFail($id);
        $claim->update([
            'status' => $data['status'],
            'response_notes' => $data['notes'] ?? null,
            'processed_at' => now(),
        ]);
        return $claim;
    }
}
