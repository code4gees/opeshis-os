<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\Auth;

class AdmitPaedsPatientAction
{
    public function execute(array $data): Admission
    {
        $admission = Admission::create([
            'admission_type' => 'paeds',
            'patient_id' => $data['patient_id'],
            'diagnosis_at_admission' => $data['diagnosis'],
            'admission_date' => now(),
            'status' => 'active',
            'admitted_by' => Auth::id(),
            'specialty_data' => [
                'ward' => $data['ward'],
                'bed_number' => $data['bed_number'] ?? null,
                'weight_kg' => $data['weight'],
            ],
            'branch_id' => Auth::user()->branch_id ?? null,
        ]);

        Opeshis::logAction('PAEDS_ADMIT', 'admissions', $admission->id, "Institutional Paediatric Admission authorized: " . $data['diagnosis']);

        return $admission;
    }
}
