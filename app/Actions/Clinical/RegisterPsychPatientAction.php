<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PsychPatient;
use App\Helpers\Opeshis;

class RegisterPsychPatientAction
{
    /**
     * Authorize Institutional Psychiatric Registration Protocol
     */
    public function execute(array $data): PsychPatient
    {
        $psychPatient = PsychPatient::create([
            'patient_id' => $data['patient_id'],
            'presenting_complaint' => $data['complaint'],
            'referral_source' => $data['source'],
            'status' => 'outpatient',
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('PSYCH_REGISTER', 'psych_patients', $psychPatient->id, "Institutional Psychiatric Enrollment authorized.");

        return $psychPatient;
    }
}
