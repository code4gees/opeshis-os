<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EyePatient extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'eye_patients';

    protected $fillable = [
        'patient_id',
        'chief_complaint',
        'registered_by'
    ];

    protected function chiefComplaint(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('chief_complaint'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function examinations()
    {
        return $this->hasMany(EyeExamination::class, 'eye_patient_id');
    }

    public function refractions()
    {
        return $this->hasMany(EyeRefraction::class, 'eye_patient_id');
    }

    public function iopReadings()
    {
        return $this->hasMany(EyeIopReading::class, 'eye_patient_id');
    }

    public function surgeries()
    {
        return $this->hasMany(EyeSurgery::class, 'eye_patient_id');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
