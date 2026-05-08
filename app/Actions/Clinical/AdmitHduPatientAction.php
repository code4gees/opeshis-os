<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\Auth;

class AdmitHduPatientAction
{
    public function execute(array $data): Admission
    {
        $admission = Admission::create([
            'admission_type' => 'hdu',
            'patient_id' => $data['patient_id'],
            'diagnosis_at_admission' => $data['diagnosis'],
            'admission_date' => now(),
            'status' => 'admitted',
            'admitted_by' => Auth::id(),
            'specialty_data' => [
                'bed_number' => $data['bed_number'],
            ],
            'branch_id' => Auth::user()->branch_id ?? null,
        ]);

        Opeshis::logAction('HDU_ADMIT', 'admissions', $admission->id, "Patient admitted to HDU surveillance.");

        return $admission;
    }
}
