<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BiometricEnrollment extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'fingerprint_template', 'device_id', 'enrolled_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}