<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MedicalRecord extends Model
{
    use HasUuids, \App\Traits\ProtectsPII, \App\Traits\Auditable;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'subjective',
        'objective',
        'assessment',
        'plan',
        'diagnosis'
    ];

    protected function subjective(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('subjective'); }
    protected function objective(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('objective'); }
    protected function assessment(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('assessment'); }
    protected function plan(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('plan'); }
    protected function diagnosis(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('diagnosis'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
