<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TheatreIntraop extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'theatre_intraop';

    protected $fillable = [
        'case_id',
        'anaesthesia_type',
        'surgeon_id',
        'anaesthetist_id',
        'incision_time',
        'closure_time',
        'operative_findings',
        'estimated_blood_loss',
        'specimens_sent',
        'status',
        'completed_by'
    ];

    protected function operativeFindings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('operative_findings'); }

    public function case()
    {
        return $this->belongsTo(TheatreCase::class, 'case_id');
    }

    public function surgeon()
    {
        return $this->belongsTo(User::class, 'surgeon_id');
    }

    public function anaesthetist()
    {
        return $this->belongsTo(User::class, 'anaesthetist_id');
    }
}
