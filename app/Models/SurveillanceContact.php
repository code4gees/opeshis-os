<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SurveillanceContact extends Model
{
    use HasUuids;

    protected $fillable = ['case_id', 'contact_name', 'relationship', 'phone'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}