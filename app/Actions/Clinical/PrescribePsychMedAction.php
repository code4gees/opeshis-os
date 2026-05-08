<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PsychMedication;
use Illuminate\Support\Facades\Auth;

class PrescribePsychMedAction
{
    public function execute(array $data): PsychMedication
    {
        return PsychMedication::create([
            'psych_patient_id' => $data['psych_patient_id'],
            'drug_name' => $data['drug'],
            'dose' => $data['dose'],
            'frequency' => $data['frequency'],
            'route' => $data['route'],
            'indication' => $data['indication'],
            'start_date' => now()->toDateString(),
            'status' => 'active',
            'prescribed_by' => Auth::id(),
        ]);
    }
}
