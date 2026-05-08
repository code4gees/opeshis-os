<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WoundRecord extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'wound_type', 'location', 'size_cm', 'stage', 'status', 'registered_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}