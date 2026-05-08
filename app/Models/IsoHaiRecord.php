<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class IsoHaiRecord extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'infection_type', 'organism', 'recorded_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}