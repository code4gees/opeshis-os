<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Helpers\Opeshis;

class AdmitObstetricsPatientAction
{
    /**
     * Authorize Institutional Obstetric Admission Protocol
     */
    public function execute(array $data): Admission
    {
        $admission = Admission::create([
            'admission_type' => 'obstetrics',
            'patient_id' => $data['patient_id'],
            'admission_reason' => $data['reason'],
            'admitted_by' => auth()->id(),
            'admission_date' => now(),
            'status' => 'admitted',
            'specialty_data' => [
                'gravida' => $data['gravida'],
                'parity' => $data['parity'],
                'gestational_age_weeks' => $data['gest_weeks'],
            ],
            'branch_id' => auth()->user()->branch_id ?? null,
        ]);

        Opeshis::logAction('OBS_ADMIT', 'admissions', $admission->id, "Protocol: Labour Ward Admission authorized.");

        return $admission;
    }
}
