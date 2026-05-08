<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PhysioSession;
use Illuminate\Support\Facades\Auth;

class RecordPhysioSessionAction
{
    public function execute(array $data): PhysioSession
    {
        return PhysioSession::create([
            'case_id' => $data['case_id'],
            'interventions' => $data['interventions'],
            'duration_minutes' => (int)$data['duration'],
            'patient_response' => $data['response'] ?? null,
            'home_exercise' => $data['home_exercise'] ?? null,
            'recorded_by' => Auth::id(),
        ]);
    }
}
