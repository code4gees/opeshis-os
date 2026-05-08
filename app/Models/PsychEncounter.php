<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PsychEncounter extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'psych_encounters';

    protected $fillable = [
        'psych_patient_id',
        'encounter_type',
        'session_notes',
        'progress',
        'plan',
        'recorded_by'
    ];

    protected function sessionNotes(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('session_notes'); }
    protected function progress(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('progress'); }
    protected function plan(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('plan'); }

    public function psychPatient()
    {
        return $this->belongsTo(PsychPatient::class, 'psych_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
