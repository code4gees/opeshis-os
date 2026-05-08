<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OncoFollowup extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'onco_followups';

    protected $fillable = [
        'onco_patient_id',
        'scheduled_date',
        'type',
        'status',
        'findings',
        'plan',
        'completed_by',
        'completed_at'
    ];

    protected function findings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('findings'); }
    protected function plan(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('plan'); }

    public function registry()
    {
        return $this->belongsTo(OncoRegistry::class, 'onco_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
}
