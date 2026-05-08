<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PhysioCase;
use App\Helpers\Opeshis;

class RegisterPhysioCaseAction
{
    /**
     * Authorize Institutional Physiotherapy Case Registration Protocol
     */
    public function execute(array $data): PhysioCase
    {
        $physioCase = PhysioCase::create([
            'patient_id' => $data['patient_id'],
            'referral_diagnosis' => $data['diagnosis'],
            'referral_source' => $data['source'],
            'goals' => $data['goals'] ?? null,
            'status' => 'active',
            'registered_by' => auth()->id(),
        ]);

        Opeshis::logAction('PHYSIO_REGISTER', 'physio_cases', $physioCase->id, "Institutional Physiotherapy Case authorized: {$data['diagnosis']}");

        return $physioCase;
    }
}
