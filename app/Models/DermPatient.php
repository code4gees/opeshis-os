<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DermPatient extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'primary_diagnosis', 'registered_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}