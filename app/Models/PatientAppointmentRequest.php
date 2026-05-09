<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PatientAppointmentRequest extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $fillable = [
        'patient_id',
        'department_id',
        'preferred_date',
        'preferred_time',
        'reason',
        'status'
    ];

    /**
     * Institutional PII Protection
     */
    protected function reason(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return $this->castPII('reason');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
