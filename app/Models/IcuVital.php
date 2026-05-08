<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class IcuVital extends Model
{
    use HasUuids, \App\Traits\Auditable, \App\Traits\ProtectsPII;

    protected $table = 'icu_vitals';

    protected $fillable = [
        'admission_id',
        'bp_systolic',
        'bp_diastolic',
        'heart_rate',
        'spo2',
        'temperature',
        'gcs',
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
