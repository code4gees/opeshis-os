<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PsychPatient;
use Illuminate\Support\Facades\Auth;

class DischargePsychPatientAction
{
    public function execute(string $id, array $data): PsychPatient
    {
        $patient = PsychPatient::findOrFail($id);
        $patient->update([
            'status' => 'discharged',
            'discharge_plan' => $data['plan'],
            'discharged_at' => now(),
            'discharged_by' => Auth::id(),
        ]);
        return $patient;
    }
}
