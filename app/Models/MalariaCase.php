<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MalariaCase extends Model
{
    use HasUuids;

    protected $fillable = [
        'patient_id',
        'species',
        'test_type',
        'result',
        'treatment_given',
        'registered_by'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
