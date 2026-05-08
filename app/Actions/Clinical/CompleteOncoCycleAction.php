<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoCycle;
use Illuminate\Support\Facades\Auth;

class CompleteOncoCycleAction
{
    public function execute(string $id, array $data): OncoCycle
    {
        $cycle = OncoCycle::findOrFail($id);
        $cycle->update([
            'status' => 'completed',
            'toxicity_grade' => $data['toxicity'],
            'nursing_notes' => $data['notes'] ?? null,
            'completed_by' => Auth::id(),
            'completed_at' => now(),
        ]);
        return $cycle;
    }
}
