<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Appointment extends Model
{
    use HasUuids, \App\Traits\ProtectsPII, \App\Traits\Auditable;

    protected $table = 'appointments';

    protected $fillable = [
        'appointment_number',
        'patient_id',
        'doctor_id',
        'department_id',
        'slot_id',
        'appointment_date',
        'appointment_time',
        'appointment_type',
        'chief_complaint',
        'priority',
        'status',
        'confirmed_at',
        'checked_in_at',
        'called_at',
        'completed_at',
        'cancelled_at',
        'cancellation_reason',
        'cancelled_by',
        'rescheduled_from_id',
        'notes',
        'booked_by',
        'booked_via',
        'reminder_sent',
        'reminder_sent_at'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
        'confirmed_at' => 'datetime',
        'checked_in_at' => 'datetime',
        'called_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
        'reminder_sent' => 'boolean',
    ];

    /**
     * Institutional PII Protection
     */
    protected function notes(): Attribute { return $this->castPII('notes'); }
    protected function chiefComplaint(): Attribute { return $this->castPII('chief_complaint'); }
    protected function cancellationReason(): Attribute { return $this->castPII('cancellation_reason'); }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'booked_by');
    }
}
