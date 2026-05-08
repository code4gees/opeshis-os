<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EyeIopReading extends Model
{
    use HasUuids;

    protected $table = 'eye_iop_readings';

    protected $fillable = [
        'eye_patient_id',
        'iop_right',
        'iop_left',
        'method',
        'recorded_by'
    ];

    public function eyePatient()
    {
        return $this->belongsTo(EyePatient::class, 'eye_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
