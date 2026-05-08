<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NicuAdmission extends Model
{
    use HasUuids, \App\Traits\Auditable;

    protected $table = 'nicu_admissions';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function mother()
    {
        return $this->belongsTo(Patient::class, 'mother_patient_id');
    }

    public function vitals()
    {
        return $this->hasMany(NicuVital::class, 'admission_id');
    }

    public function latestVital()
    {
        return $this->hasOne(NicuVital::class, 'admission_id')->latestOfMany();
    }

    public function feedingLogs()
    {
        return $this->hasMany(NicuFeeding::class, 'admission_id');
    }

    public function latestFeeding()
    {
        return $this->hasOne(NicuFeeding::class, 'admission_id')->latestOfMany();
    }
}
