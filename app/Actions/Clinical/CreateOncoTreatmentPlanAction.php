<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoTreatmentPlan;
use App\Helpers\Opeshis;

class CreateOncoTreatmentPlanAction
{
    /**
     * Authorize Institutional Chemotherapy Treatment Plan Protocol
     */
    public function execute(array $data): OncoTreatmentPlan
    {
        $bsa = round(sqrt(($data['height'] * $data['weight']) / 3600), 2);

        $plan = OncoTreatmentPlan::create([
            'onco_patient_id' => $data['onco_patient_id'],
            'protocol_id' => $data['protocol_id'],
            'intent' => $data['intent'],
            'bsa' => $bsa,
            'weight_kg' => $data['weight'],
            'height_cm' => $data['height'],
            'total_cycles' => $data['cycles'],
            'status' => 'active',
            'created_by' => auth()->id(),
        ]);

        Opeshis::logAction('ONCO_PLAN_CREATE', 'onco_treatment_plans', $plan->id, "Institutional Chemotherapy Protocol Authorized");

        return $plan;
    }
}
