<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\Patient;
use App\Models\MedicalIdPool;
use App\Helpers\Opeshis;
use Illuminate\Support\Facades\DB;

class RegisterPatientAction
{
    /**
     * Authorize Institutional Patient Enrollment Protocol
     */
    public function execute(array $data): Patient
    {
        return DB::transaction(function() use ($data) {
            $medicalIdPool = MedicalIdPool::where('status', 'unassigned')
                ->lockForUpdate()
                ->first();
            
            if (!$medicalIdPool) {
                throw new \Exception("Institutional Medical ID pool exhausted. Registration suspended.");
            }
            
            $medicalId = $medicalIdPool->medical_id;

            $patient = Patient::create([
                'medical_id' => $medicalId,
                'full_name' => $data['full_name'],
                'phone' => $data['phone'] ?? '',
                'gender' => $data['gender'],
                'dob' => $data['dob'],
            ]);

            $medicalIdPool->update([
                'status' => 'assigned',
                'patient_id' => $patient->id,
                'assigned_at' => now()
            ]);

            Opeshis::logAction('PATIENT_REGISTER', 'patients', $patient->id, ['medical_id' => $medicalId]);

            return $patient;
        });
    }
}
