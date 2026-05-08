<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PhysioCase;
use Illuminate\Support\Facades\Auth;

class RecordPhysioOutcomeAction
{
    public function execute(string $caseId, array $data): PhysioCase
    {
        $case = PhysioCase::findOrFail($caseId);
        
        $case->update([
            'outcome' => $data['outcome'],
            'goal_achieved' => (bool)$data['achieved'],
            'status' => 'closed',
            'closed_at' => now(),
            'closed_by' => Auth::id(),
        ]);

        return $case;
    }
}
