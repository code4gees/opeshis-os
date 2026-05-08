<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Helpers\Opeshis;

class DischargePaedsPatientAction
{
    public function execute(string $id, array $data): void
    {
        $admission = Admission::findOrFail($id);
        $admission->update([
            'status' => 'discharged',
            'discharge_summary' => $data['summary'],
            'discharge_date' => now(),
        ]);

        Opeshis::logAction('PAEDS_DISCHARGE', 'admissions', $id, 'Institutional Discharge Protocol Finalized');
    }
}
