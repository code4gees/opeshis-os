<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoNursingAssessment;
use Illuminate\Support\Facades\Auth;

class LogOncoNursingAssessmentAction
{
    public function execute(array $data): OncoNursingAssessment
    {
        return OncoNursingAssessment::create([
            'plan_id' => $data['plan_id'],
            'ecog_score' => $data['ecog'],
            'pain_score' => $data['pain'],
            'nausea_grade' => $data['nausea'],
            'fatigue_grade' => $data['fatigue'],
            'notes' => $data['notes'] ?? null,
            'recorded_by' => Auth::id(),
        ]);
    }
}
