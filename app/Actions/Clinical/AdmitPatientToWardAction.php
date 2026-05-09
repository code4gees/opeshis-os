<?php

namespace App\Actions\Clinical;

use App\Models\Admission;
use App\Models\WardBed;
use App\Models\Patient;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdmitPatientToWardAction
{
    /**
     * Authorize Institutional Ward Admission
     */
    public function execute(array $data): Admission
    {
        // Resolve Institutional Identity
        $patient = Patient::where('id', $data['patient_id'])
            ->orWhere('medical_id', $data['patient_id'])
            ->firstOrFail();

        return DB::transaction(function() use ($data, $patient) {
            $admission = Admission::create([
                'admission_type' => 'general',
                'patient_id' => $patient->id,
                'ward_id' => $data['ward_id'],
                'bed_id' => $data['bed_id'],
                'diagnosis_at_admission' => $data['diagnosis'],
                'status' => 'admitted',
                'admission_date' => now(),
                'admitted_by' => Auth::id(),
                'branch_id' => Auth::user()->branch_id ?? null,
            ]);

            WardBed::where('id', $data['bed_id'])->update([
                'status' => 'occupied',
                'patient_id' => $patient->id
            ]);

            Opeshis::logAction('WARD_ADMIT', 'admissions', $admission->id, "Institutional Ward Admission: Bed ID {$data['bed_id']}");

            return $admission;
        });
    }
}
