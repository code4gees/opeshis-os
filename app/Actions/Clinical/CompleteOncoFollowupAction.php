<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoFollowup;
use Illuminate\Support\Facades\Auth;

class CompleteOncoFollowupAction
{
    public function execute(string $id, array $data): OncoFollowup
    {
        $followup = OncoFollowup::findOrFail($id);
        $followup->update([
            'status' => 'completed',
            'findings' => $data['findings'],
            'plan' => $data['plan'],
            'completed_by' => Auth::id(),
            'completed_at' => now(),
        ]);
        return $followup;
    }
}
