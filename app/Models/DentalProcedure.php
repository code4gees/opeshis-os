<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DentalProcedure extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'dental_procedures';

    protected $fillable = [
        'dental_patient_id',
        'procedure_code',
        'tooth_number',
        'findings',
        'treatment',
        'cost',
        'recorded_by'
    ];

    protected function findings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('findings'); }
    protected function treatment(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('treatment'); }

    public function dentalPatient()
    {
        return $this->belongsTo(DentalPatient::class, 'dental_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
