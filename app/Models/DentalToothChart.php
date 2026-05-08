<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DentalToothChart extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'dental_tooth_charts';

    protected $fillable = [
        'dental_patient_id',
        'tooth_number',
        'status',
        'notes'
    ];

    protected function notes(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('notes'); }

    public function dentalPatient()
    {
        return $this->belongsTo(DentalPatient::class, 'dental_patient_id');
    }
}
