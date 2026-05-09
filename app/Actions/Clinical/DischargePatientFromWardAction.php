<?php

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Models\WardBed;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;

class DischargePatientFromWardAction
{
    /**
     * Finalize Institutional Ward Discharge Protocol
     */
    public function execute(string $admissionId, ?string $summary): void
    {
        $admission = Admission::findOrFail($admissionId);
        
        DB::transaction(function() use ($admission, $summary) {
            $admission->update([
                'status' => 'discharged',
                'discharge_date' => now(),
                'discharge_summary' => $summary,
            ]);

            if ($admission->bed_id) {
                WardBed::where('id', $admission->bed_id)->update([
                    'status' => 'available',
                    'patient_id' => null
                ]);
            }

            Opeshis::logAction('WARD_DISCHARGE', 'admissions', $admission->id, "Institutional Ward Discharge finalized.");
        });
    }
}
