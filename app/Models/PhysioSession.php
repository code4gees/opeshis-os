<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PhysioSession extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'physio_sessions';

    protected $fillable = [
        'case_id',
        'interventions',
        'duration_minutes',
        'patient_response',
        'home_exercise',
        'recorded_by'
    ];

    protected function interventions(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('interventions'); }
    protected function patientResponse(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('patient_response'); }
    protected function homeExercise(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('home_exercise'); }

    public function physioCase()
    {
        return $this->belongsTo(PhysioCase::class, 'case_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
