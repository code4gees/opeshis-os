<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PhysioAssessment;
use Illuminate\Support\Facades\Auth;

class RecordPhysioAssessmentAction
{
    public function execute(array $data): PhysioAssessment
    {
        return PhysioAssessment::create([
            'case_id' => $data['case_id'],
            'subjective' => $data['subjective'],
            'objective' => $data['objective'],
            'assessment' => $data['assessment'],
            'plan' => $data['plan'],
            'rom_findings' => $data['rom'] ?? null,
            'strength_findings' => $data['strength'] ?? null,
            'recorded_by' => Auth::id(),
        ]);
    }
}
