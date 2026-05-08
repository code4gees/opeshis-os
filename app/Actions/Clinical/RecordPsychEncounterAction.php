<?php

declare(strict_types=1);

namespace App\Actions\Clinical;

use App\Models\PsychEncounter;
use Illuminate\Support\Facades\Auth;

class RecordPsychEncounterAction
{
    public function execute(array $data): PsychEncounter
    {
        return PsychEncounter::create([
            'psych_patient_id' => $data['psych_patient_id'],
            'encounter_type' => $data['type'],
            'session_notes' => $data['notes'],
            'progress' => $data['progress'],
            'plan' => $data['plan'],
            'recorded_by' => Auth::id(),
        ]);
    }
}
