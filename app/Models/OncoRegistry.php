<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OncoRegistry extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'onco_registry';

    protected $fillable = [
        'patient_id',
        'cancer_type',
        'icd_code',
        'stage',
        'histology',
        'date_of_diagnosis',
        'registered_by'
    ];

    protected function cancerType(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('cancer_type'); }
    protected function icdCode(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('icd_code'); }
    protected function histology(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('histology'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function treatmentPlans()
    {
        return $this->hasMany(OncoTreatmentPlan::class, 'onco_patient_id');
    }

    public function activePlan()
    {
        return $this->hasOne(OncoTreatmentPlan::class, 'onco_patient_id')->where('status', 'active');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
