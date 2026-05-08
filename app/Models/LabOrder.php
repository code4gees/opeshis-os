<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LabOrder extends Model
{
    use HasUuids, \App\Traits\Auditable;

    protected $table = 'lab_orders';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'status',
        'ordered_by',
        'ordered_at'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function items()
    {
        return $this->hasMany(LabOrderItem::class, 'order_id');
    }

    public function encounter()
    {
        return $this->belongsTo(OpdEncounter::class, 'visit_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'ordered_by');
    }
}
