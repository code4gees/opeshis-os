<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaedsAdmission extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'paeds_admissions';

    protected $fillable = [
        'patient_id',
        'ward',
        'bed_number',
        'admitting_diagnosis',
        'weight_kg',
        'status',
        'discharge_summary',
        'admitted_by',
        'admitted_at',
        'discharged_at',
        'discharged_by'
    ];

    protected function admittingDiagnosis(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('admitting_diagnosis'); }
    protected function dischargeSummary(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('discharge_summary'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function vitals()
    {
        return $this->hasMany(PaedsVital::class, 'admission_id');
    }

    public function growth()
    {
        return $this->hasMany(PaedsGrowth::class, 'admission_id');
    }
}
