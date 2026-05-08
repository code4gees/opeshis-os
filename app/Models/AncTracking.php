<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AncTracking extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'anc_tracking';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'lmp_date',
        'edd_date',
        'gravida',
        'parity'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
