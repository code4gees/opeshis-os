<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PatientAppointmentRequest extends Model
{
    use HasUuids;

    protected $fillable = [
        'patient_id',
        'department_id',
        'preferred_date',
        'preferred_time',
        'reason',
        'status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
