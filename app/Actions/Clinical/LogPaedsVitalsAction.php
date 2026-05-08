<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PaedsVital;
use Illuminate\Support\Facades\Auth;

class LogPaedsVitalsAction
{
    public function execute(array $data): PaedsVital
    {
        return PaedsVital::create([
            'admission_id' => $data['admission_id'],
            'temperature' => $data['temperature'] ?? null,
            'heart_rate' => $data['heart_rate'] ?? null,
            'resp_rate' => $data['resp_rate'] ?? null,
            'spo2' => $data['spo2'] ?? null,
            'bp_systolic' => $data['bp_systolic'] ?? null,
            'bp_diastolic' => $data['bp_diastolic'] ?? null,
            'recorded_by' => Auth::id(),
        ]);
    }
}
