<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Admission extends Model
{
    use HasUuids, \App\Traits\ProtectsPII, \App\Traits\Auditable;

    protected $table = 'admissions';

    protected $fillable = [
        'admission_type',
        'patient_id',
        'bed_id',
        'ward_id',
        'admitting_doctor_id',
        'admitted_by',
        'diagnosis_at_admission',
        'admission_reason',
        'admission_date',
        'discharge_date',
        'discharge_summary',
        'status',
        'assigned_nurse_id',
        'outcome',
        'specialty_data',
        'branch_id'
    ];

    protected $casts = [
        'admission_date' => 'datetime',
        'discharge_date' => 'datetime',
        'specialty_data' => 'array',
    ];

    /**
     * Institutional PII Protection
     */
    protected function diagnosisAtAdmission(): Attribute { return $this->castPII('diagnosis_at_admission'); }
    protected function admissionReason(): Attribute { return $this->castPII('admission_reason'); }
    protected function dischargeSummary(): Attribute { return $this->castPII('discharge_summary'); }

    /**
     * Institutional Core Relationships
     */
    public function patient() { return $this->belongsTo(Patient::class, 'patient_id'); }
    public function bed() { return $this->belongsTo(WardBed::class, 'bed_id'); }
    public function ward() { return $this->belongsTo(Ward::class, 'ward_id'); }
    public function doctor() { return $this->belongsTo(User::class, 'admitting_doctor_id'); }
    public function nurse() { return $this->belongsTo(User::class, 'assigned_nurse_id'); }

    /**
     * Specialty Unit Relationships (Institutional Intelligence)
     */
    public function icuVitals() { return $this->hasMany(IcuVital::class, 'admission_id'); }
    public function icuLatestVital() { return $this->hasOne(IcuVital::class, 'admission_id')->latestOfMany(); }
    public function icuSofaScores() { return $this->hasMany(IcuSofaScore::class, 'admission_id'); }
    public function icuLatestSofa() { return $this->hasOne(IcuSofaScore::class, 'admission_id')->latestOfMany(); }

    public function obsObservations() { return $this->hasMany(ObstetricsObservation::class, 'admission_id'); }
    public function obsDeliveries() { return $this->hasMany(ObstetricsDelivery::class, 'admission_id'); }

    public function paedsVitals() { return $this->hasMany(PaedsVital::class, 'admission_id'); }
    public function paedsGrowth() { return $this->hasMany(PaedsGrowth::class, 'admission_id'); }

    public function nicuVitals() { return $this->hasMany(NicuVital::class, 'admission_id'); }
    public function nicuFeeding() { return $this->hasMany(NicuFeeding::class, 'admission_id'); }

    public function hduVitals() { return $this->hasMany(HduVital::class, 'admission_id'); }

    /**
     * Legacy Aliases for Compatibility (Phase 2 Normalization)
     */
    public function latestVital() 
    { 
        if ($this->admission_type === 'icu') return $this->icuLatestVital();
        if ($this->admission_type === 'paeds') return $this->hasOne(PaedsVital::class, 'admission_id')->latestOfMany();
        if ($this->admission_type === 'nicu') return $this->hasOne(NicuVital::class, 'admission_id')->latestOfMany();
        return $this->hasOne(NursingRound::class, 'admission_id')->latestOfMany(); 
    }

    public function latestSofa() { return $this->icuLatestSofa(); }
    public function latestFeeding() { return $this->hasOne(NicuFeeding::class, 'admission_id')->latestOfMany(); }
    public function observations() { return $this->obsObservations(); }
    public function deliveries() { return $this->obsDeliveries(); }
}
