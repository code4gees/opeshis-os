<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\DialysisPatient;
use App\Helpers\Opeshis;

class RegisterRenalPatientAction
{
    /**
     * Authorize Institutional Renal Patient Registration Protocol
     */
    public function execute(array $data): DialysisPatient
    {
        $dp = DialysisPatient::create(array_merge($data, [
            'status' => 'active',
            'registered_by' => auth()->id(),
        ]));
        
        Opeshis::logAction('DIALYSIS_REGISTER', 'dialysis_patients', $dp->id, 'Institutional Renal Enrollment authorized.');
        
        return $dp;
    }
}
