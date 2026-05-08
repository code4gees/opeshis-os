<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Prescription extends Model
{
    use HasUuids, \App\Traits\Auditable;

    protected $table = 'prescriptions';

    protected $fillable = [
        'patient_id',
        'visit_id',
        'inventory_id',
        'dosage',
        'duration',
        'instructions',
        'status',
        'prescribed_by'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function encounter()
    {
        return $this->belongsTo(OpdEncounter::class, 'visit_id');
    }

    public function prescriber()
    {
        return $this->belongsTo(User::class, 'prescribed_by');
    }
}
