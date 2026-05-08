<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DialysisPdSession extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'dialysis_pd_sessions';

    protected $fillable = [
        'dialysis_patient_id',
        'fill_volume',
        'dwell_time',
        'drain_volume',
        'ultrafiltration',
        'solution_type',
        'status',
        'recorded_by'
    ];

    protected function solutionType(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('solution_type'); }

    public function patient()
    {
        return $this->belongsTo(DialysisPatient::class, 'dialysis_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
