<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SurveillanceCase extends Model
{
    use HasUuids, \App\Traits\Auditable, \App\Traits\ProtectsPII;

    protected $fillable = ['patient_id', 'disease_code', 'outcome', 'reported_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}