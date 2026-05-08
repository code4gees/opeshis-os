<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Helpers\Opeshis;

class EscalatePatientToIcuAction
{
    public function execute(string $id): void
    {
        $admission = Admission::findOrFail($id);
        $admission->update([
            'status' => 'escalated_icu',
            'admission_type' => 'icu',
            'updated_at' => now()
        ]);

        Opeshis::logAction('HDU_ESCALATE_ICU', 'admissions', $id, "Patient escalated from HDU to ICU protocol.");
    }
}
