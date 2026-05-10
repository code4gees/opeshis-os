<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OpdEncounter extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory, \Illuminate\Database\Eloquent\Concerns\HasUuids, \App\Traits\Auditable, \App\Traits\ProtectsPII;

    protected $table = 'opd_encounters';

    protected $fillable = [
        'patient_id',
        'active_queue_id',
        'encounter_number',
        'check_in_time',
        'assigned_doctor_id',
        'triage_category',
        'status',
        'branch_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'assigned_doctor_id');
    }

    public function consultation()
    {
        return $this->hasOne(OpdConsultation::class, 'encounter_id', 'id');
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class, 'visit_id', 'id');
    }
}
