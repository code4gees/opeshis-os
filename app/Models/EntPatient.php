<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EntPatient extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'ent_patients';

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
        return $this->hasMany(EntExamination::class, 'ent_patient_id');
    }

    public function audiograms()
    {
        return $this->hasMany(EntAudiogram::class, 'ent_patient_id');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
