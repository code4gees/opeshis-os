<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EClaim extends Model
{
    use HasUuids;

    protected $fillable = ['claim_number', 'patient_id', 'provider_id', 'encounter_date', 'diagnosis_codes', 'total_claimed', 'status', 'submitted_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}