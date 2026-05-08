<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WardBed extends Model
{
    use HasUuids;

    protected $table = 'ward_beds';

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
