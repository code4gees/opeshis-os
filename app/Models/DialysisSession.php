<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DialysisSession extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'dialysis_sessions';

    protected $fillable = [
        'dialysis_patient_id',
        'machine_id',
        'pre_weight',
        'post_weight',
        'uf_goal',
        'uf_achieved',
        'duration_hours',
        'blood_flow_rate',
        'dialysate_flow_rate',
        'kt_v',
        'status',
        'complications',
        'abort_reason',
        'started_at',
        'completed_at',
        'aborted_at',
        'started_by',
        'completed_by',
        'aborted_by'
    ];

    protected function complications(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('complications'); }
    protected function abortReason(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('abort_reason'); }

    public function patient()
    {
        return $this->belongsTo(DialysisPatient::class, 'dialysis_patient_id');
    }

    public function machine()
    {
        return $this->belongsTo(DialysisMachine::class, 'machine_id');
    }

    public function vitals()
    {
        return $this->hasMany(DialysisVital::class, 'session_id');
    }

    public function starter()
    {
        return $this->belongsTo(User::class, 'started_by');
    }

    public function completer()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    public function aborter()
    {
        return $this->belongsTo(User::class, 'aborted_by');
    }
}
