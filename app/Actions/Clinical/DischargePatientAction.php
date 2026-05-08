<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Helpers\Opeshis;

class DischargePatientAction
{
    /**
     * Finalize Institutional Discharge Protocol
     */
    public function execute(string $id, array $data): void
    {
        $admission = Admission::findOrFail($id);
        
        $admission->update([
            'status' => 'discharged',
            'discharge_date' => now(),
            'discharge_notes' => $data['notes'] ?? ($data['destination'] ?? null),
        ]);

        Opeshis::logAction('DISCHARGE', 'admissions', $id, "Institutional Discharge Protocol finalized.");
    }
}
