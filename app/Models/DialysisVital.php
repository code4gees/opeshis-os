<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DialysisVital extends Model
{
    use HasUuids;

    protected $table = 'dialysis_vitals';

    protected $fillable = [
        'session_id',
        'bp_systolic',
        'bp_diastolic',
        'heart_rate',
        'temperature',
        'blood_flow',
        'venous_pressure',
        'recorded_by'
    ];

    public function session()
    {
        return $this->belongsTo(DialysisSession::class, 'session_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
