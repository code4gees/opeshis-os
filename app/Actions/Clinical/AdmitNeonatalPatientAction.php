<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Helpers\Opeshis;

class AdmitNeonatalPatientAction
{
    /**
     * Authorize Neonatal Admission Protocol
     */
    public function execute(array $data): Admission
    {
        $admission = Admission::create([
            'admission_type' => 'nicu',
            'patient_id' => $data['patient_id'],
            'diagnosis_at_admission' => $data['diagnosis'],
            'admitted_by' => auth()->id(),
            'admission_date' => now(),
            'status' => 'admitted',
            'specialty_data' => [
                'mother_patient_id' => $data['mother_id'],
                'birth_weight' => $data['birth_weight'],
                'gestational_age' => $data['gestational_age'],
            ],
            'branch_id' => auth()->user()->branch_id ?? null,
        ]);

        Opeshis::logAction('NICU_ADMIT', 'admissions', $admission->id, "Baby admitted to NICU protocol.");

        return $admission;
    }
}
