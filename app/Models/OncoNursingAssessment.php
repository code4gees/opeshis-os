<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OncoNursingAssessment extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'onco_nursing_assessments';

    protected $fillable = [
        'plan_id',
        'ecog_score',
        'pain_score',
        'nausea_grade',
        'fatigue_grade',
        'notes',
        'recorded_by'
    ];

    protected function notes(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('notes'); }

    public function plan()
    {
        return $this->belongsTo(OncoTreatmentPlan::class, 'plan_id');
    }

    public function nurse()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
