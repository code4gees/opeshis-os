<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PftMeasurement extends Model
{
    use HasUuids;

    protected $fillable = ['session_id', 'fvc', 'fev1', 'fev1_fvc_ratio', 'pef', 'recorded_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}