<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\HduVital;
use Illuminate\Support\Facades\Auth;

class LogHduVitalsAction
{
    public function execute(array $data): HduVital
    {
        return HduVital::create([
            'admission_id' => $data['admission_id'],
            'bp_systolic' => $data['bp_systolic'] ?? null,
            'bp_diastolic' => $data['bp_diastolic'] ?? null,
            'heart_rate' => $data['heart_rate'] ?? null,
            'spo2' => $data['spo2'] ?? null,
            'temperature' => $data['temperature'] ?? null,
            'recorded_by' => Auth::id(),
        ]);
    }
}
