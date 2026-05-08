<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Helpers\Opeshis;

class AdmitIcuPatientAction
{
    /**
     * Authorize Institutional Critical Care Admission Protocol
     */
    public function execute(array $data): Admission
    {
        $admission = Admission::create([
            'admission_type' => 'icu',
            'patient_id' => $data['patient_id'],
            'diagnosis_at_admission' => $data['diagnosis'],
            'admission_date' => now(),
            'status' => 'admitted',
            'admitted_by' => auth()->id(),
            'specialty_data' => [
                'bed_number' => $data['bed_number'],
                'source_unit' => $data['source'] ?? null,
            ],
            'branch_id' => auth()->user()->branch_id ?? null,
        ]);

        Opeshis::logAction('ICU_ADMIT', 'admissions', $admission->id, "Institutional ICU Admission authorized: Bed {$data['bed_number']}");

        return $admission;
    }
}
