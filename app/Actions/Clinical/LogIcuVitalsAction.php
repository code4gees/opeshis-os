<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\IcuVital;

class LogIcuVitalsAction
{
    /**
     * Commit Institutional Hemodynamic Vitals Protocol
     */
    public function execute(array $data): IcuVital
    {
        return IcuVital::create([
            'admission_id' => $data['admission_id'],
            'bp_systolic' => $data['bp_systolic'],
            'bp_diastolic' => $data['bp_diastolic'],
            'heart_rate' => $data['heart_rate'],
            'spo2' => $data['spo2'],
            'temperature' => $data['temperature'],
            'gcs' => $data['gcs'],
            'recorded_by' => auth()->id(),
        ]);
    }
}
