<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaedsVital extends Model
{
    use HasUuids, \App\Traits\Auditable, \App\Traits\ProtectsPII;

    protected $table = 'paeds_vitals';

    protected $fillable = [
        'admission_id',
        'temperature',
        'heart_rate',
        'resp_rate',
        'spo2',
        'bp_systolic',
        'bp_diastolic',
        'recorded_by'
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
