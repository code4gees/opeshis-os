<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\ObstetricsObservation;
use App\Models\Admission;
use Illuminate\Support\Facades\Auth;

class LogObstetricsObservationAction
{
    public function execute(array $data): ObstetricsObservation
    {
        // Verify admission exists in unified registry
        Admission::findOrFail($data['admission_id']);

        return ObstetricsObservation::create([
            'admission_id' => $data['admission_id'],
            'fetal_heart_rate' => $data['fhr'],
            'uterine_contractions' => $data['contractions'],
            'cervical_dilation_cm' => $data['dilation'],
            'presentation' => $data['presentation'],
            'notes' => $data['notes'] ?? null,
            'recorded_by' => Auth::id(),
        ]);
    }
}
