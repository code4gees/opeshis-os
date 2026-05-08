<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\OncoRegistry;
use App\Helpers\Opeshis;

class RegisterOncoDiagnosisAction
{
    /**
     * Authorize Institutional Cancer Diagnosis Enrollment Protocol
     */
    public function execute(array $data): OncoRegistry
    {
        $registry = OncoRegistry::create([
            'patient_id' => $data['patient_id'],
            'cancer_type' => $data['type'],
            'icd_code' => $data['icd'],
            'stage' => $data['stage'],
            'histology' => $data['histology'],
            'date_of_diagnosis' => $data['diagnosis_date'],
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('ONCO_REGISTER', 'onco_registry', $registry->id, "Institutional Diagnosis Enrollment: " . $data['type']);

        return $registry;
    }
}
