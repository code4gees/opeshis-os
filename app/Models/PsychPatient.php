<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PsychPatient extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'psych_patients';

    protected $fillable = [
        'patient_id',
        'presenting_complaint',
        'referral_source',
        'status',
        'admission_reason',
        'admitted_at',
        'admitted_by',
        'discharge_plan',
        'discharged_at',
        'discharged_by',
        'registered_by'
    ];

    protected function presentingComplaint(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('presenting_complaint'); }
    protected function referralSource(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('referral_source'); }
    protected function admissionReason(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('admission_reason'); }
    protected function dischargePlan(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('discharge_plan'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function mseLogs()
    {
        return $this->hasMany(PsychMSE::class, 'psych_patient_id');
    }

    public function riskAssessments()
    {
        return $this->hasMany(PsychRiskAssessment::class, 'psych_patient_id');
    }

    public function medications()
    {
        return $this->hasMany(PsychMedication::class, 'psych_patient_id');
    }

    public function encounters()
    {
        return $this->hasMany(PsychEncounter::class, 'psych_patient_id');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function admittingClinician()
    {
        return $this->belongsTo(User::class, 'admitted_by');
    }

    public function dischargingClinician()
    {
        return $this->belongsTo(User::class, 'discharged_by');
    }
}
