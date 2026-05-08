<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\SurveillanceCase;
use App\Models\SurveillanceDisease;
use App\Models\SurveillanceAlert;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\Auth;

class ReportSurveillanceCaseAction
{
    public function execute(array $data): SurveillanceCase
    {
        $case = SurveillanceCase::create([
            'patient_id' => $data['patient_id'],
            'disease_code' => $data['disease_code'],
            'outcome' => 'under_investigation',
            'reported_by' => Auth::id(),
        ]);

        $this->checkOutbreakThreshold($data['disease_code']);

        Opeshis::logAction('SURV_REPORT', 'surveillance_cases', $case->id, "Protocol: IDSR case reported for {$data['disease_code']}. Threshold analysis executed.");

        return $case;
    }

    private function checkOutbreakThreshold(string $diseaseCode): void
    {
        $disease = SurveillanceDisease::where('disease_code', $diseaseCode)->first();
        if (!$disease) return;

        $caseCount = SurveillanceCase::where('disease_code', $diseaseCode)
            ->where('created_at', '>=', now()->subDays($disease->outbreak_threshold_days))
            ->count();

        if ($caseCount >= $disease->outbreak_threshold_cases) {
            $existing = SurveillanceAlert::where('disease_id', $disease->id)
                ->where('resolved', false)
                ->first();

            if (!$existing) {
                $level = 'WATCH';
                if ($caseCount >= $disease->outbreak_threshold_cases * 2) $level = 'WARNING';
                if ($caseCount >= $disease->outbreak_threshold_cases * 3) $level = 'ACTION';
                if ($disease->is_immediately_reportable) $level = 'EMERGENCY';

                SurveillanceAlert::create([
                    'disease_id' => $disease->id,
                    'alert_type' => 'THRESHOLD_EXCEEDED',
                    'alert_level' => $level,
                    'case_count' => $caseCount,
                    'description' => "CRITICAL: {$caseCount} cases of {$disease->disease_name} detected within {$disease->outbreak_threshold_days} days. Threshold protocol triggered.",
                ]);
            }
        }
    }
}
