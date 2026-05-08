<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PsychRiskAssessment;
use Illuminate\Support\Facades\Auth;

class RecordPsychRiskAction
{
    public function execute(array $data): PsychRiskAssessment
    {
        return PsychRiskAssessment::create([
            'psych_patient_id' => $data['psych_patient_id'],
            'suicidal_ideation' => $data['suicidal'],
            'self_harm_risk' => $data['self_harm'],
            'violence_risk' => $data['violence'],
            'risk_level' => $data['risk_level'],
            'protective_factors' => $data['protective'] ?? null,
            'safety_plan' => $data['safety_plan'] ?? null,
            'recorded_by' => Auth::id(),
        ]);
    }
}
