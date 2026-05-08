<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PsychRiskAssessment extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'psych_risk_assessments';

    protected $fillable = [
        'psych_patient_id',
        'suicidal_ideation',
        'self_harm_risk',
        'violence_risk',
        'risk_level',
        'protective_factors',
        'safety_plan',
        'recorded_by'
    ];

    protected function suicidalIdeation(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('suicidal_ideation'); }
    protected function selfHarmRisk(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('self_harm_risk'); }
    protected function violenceRisk(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('violence_risk'); }
    protected function protectiveFactors(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('protective_factors'); }
    protected function safety_plan(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('safety_plan'); }

    public function psychPatient()
    {
        return $this->belongsTo(PsychPatient::class, 'psych_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
