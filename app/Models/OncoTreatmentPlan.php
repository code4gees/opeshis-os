<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OncoTreatmentPlan extends Model
{
    use HasUuids;

    protected $table = 'onco_treatment_plans';

    protected $fillable = [
        'onco_patient_id',
        'protocol_id',
        'intent',
        'bsa',
        'weight_kg',
        'height_cm',
        'total_cycles',
        'status',
        'created_by'
    ];

    public function registry()
    {
        return $this->belongsTo(OncoRegistry::class, 'onco_patient_id');
    }

    public function protocol()
    {
        return $this->belongsTo(OncoProtocol::class, 'protocol_id');
    }

    public function drugAdministrations()
    {
        return $this->hasMany(OncoDrugAdmin::class, 'plan_id');
    }

    public function cycles()
    {
        return $this->hasMany(OncoCycle::class, 'plan_id');
    }

    public function nursingAssessments()
    {
        return $this->hasMany(OncoNursingAssessment::class, 'plan_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
