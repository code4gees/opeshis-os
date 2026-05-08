<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DermPatient;
use App\Helpers\Opeshis;

class RegisterDermPatientAction
{
    /**
     * Authorize Institutional Dermatology Registration Protocol
     */
    public function execute(array $data): DermPatient
    {
        $dermPatient = DermPatient::create([
            'patient_id' => $data['patient_id'],
            'primary_diagnosis' => $data['diagnosis'],
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('DERM_REGISTER', 'derm_patients', $dermPatient->id, "Institutional Dermatology Enrollment authorized.");

        return $dermPatient;
    }
}
