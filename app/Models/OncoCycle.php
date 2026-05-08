<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns:HasUuids;

class OncoCycle extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'onco_cycles';

    protected $fillable = [
        'plan_id',
        'cycle_number',
        'scheduled_date',
        'status',
        'toxicity_grade',
        'nursing_notes',
        'cleared_by',
        'cleared_at',
        'completed_by',
        'completed_at'
    ];

    protected function nursingNotes(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('nursing_notes'); }

    public function plan()
    {
        return $this->belongsTo(OncoTreatmentPlan::class, 'plan_id');
    }

    public function clearer()
    {
        return $this->belongsTo(User::class, 'cleared_by');
    }

    public function completer()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
}
