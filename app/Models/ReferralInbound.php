<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReferralInbound extends Model
{
    use HasUuids;

    protected $fillable = ['patient_name', 'referring_facility', 'reason', 'received_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}