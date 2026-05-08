<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReferralOutbound extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'facility_name', 'reason', 'urgency', 'status', 'referred_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}