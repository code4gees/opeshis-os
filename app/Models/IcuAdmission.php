<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class IcuAdmission extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'icu_admissions';

    protected $fillable = [
        'patient_id',
        'bed_number',
        'admitting_diagnosis',
        'source_unit',
        'admitted_by',
        'admitted_at',
        'status',
        'discharge_destination',
        'discharged_at'
    ];

    protected function admittingDiagnosis(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('admitting_diagnosis'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function vitals()
    {
        return $this->hasMany(IcuVital::class, 'admission_id');
    }

    public function latestVital()
    {
        return $this->hasOne(IcuVital::class, 'admission_id')->latestOfMany();
    }

    public function sofaScores()
    {
        return $this->hasMany(IcuSofaScore::class, 'admission_id');
    }

    public function latestSofa()
    {
        return $this->hasOne(IcuSofaScore::class, 'admission_id')->latestOfMany();
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'admitted_by');
    }
}
