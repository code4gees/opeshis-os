<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DentalPatient extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'dental_patients';

    protected $fillable = [
        'patient_id',
        'chief_complaint',
        'registered_by'
    ];

    protected function chiefComplaint(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('chief_complaint'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function appointments()
    {
        return $this->hasMany(DentalAppointment::class, 'dental_patient_id');
    }

    public function procedures()
    {
        return $this->hasMany(DentalProcedure::class, 'dental_patient_id');
    }

    public function chart()
    {
        return $this->hasMany(DentalToothChart::class, 'dental_patient_id');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
