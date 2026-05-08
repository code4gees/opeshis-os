<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WardAdmission extends Model
{
    use HasUuids;

    protected $table = 'ward_admissions';

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function bed()
    {
        return $this->belongsTo(WardBed::class, 'bed_id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }
}
