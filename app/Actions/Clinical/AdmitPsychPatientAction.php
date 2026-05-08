<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PsychPatient;
use Illuminate\Support\Facades\Auth;

class AdmitPsychPatientAction
{
    public function execute(array $data): PsychPatient
    {
        $patient = PsychPatient::findOrFail($data['psych_patient_id']);
        $patient->update([
            'status' => 'inpatient',
            'admission_reason' => $data['reason'],
            'admitted_at' => now(),
            'admitted_by' => Auth::id(),
        ]);
        return $patient;
    }
}
