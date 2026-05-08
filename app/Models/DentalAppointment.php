<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DentalAppointment extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'dental_appointments';

    protected $fillable = [
        'dental_patient_id',
        'appointment_date',
        'appointment_time',
        'reason',
        'status'
    ];

    protected function reason(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('reason'); }

    public function dentalPatient()
    {
        return $this->belongsTo(DentalPatient::class, 'dental_patient_id');
    }
}
