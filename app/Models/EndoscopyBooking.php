<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EndoscopyBooking extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'endoscopy_bookings';

    protected $fillable = [
        'patient_id',
        'procedure_type',
        'indication',
        'scheduled_date',
        'scope_id',
        'status',
        'booked_by'
    ];

    protected function indication(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('indication'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function report()
    {
        return $this->hasOne(EndoscopyReport::class, 'booking_id');
    }

    public function biopsies()
    {
        return $this->hasMany(EndoscopyBiopsy::class, 'booking_id');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'booked_by');
    }
}
