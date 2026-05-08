<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SurveillanceAlert extends Model
{
    use HasUuids;

    protected $table = 'surveillance_alerts';
    protected $guarded = [];

    public function disease()
    {
        return $this->belongsTo(SurveillanceDisease::class, 'disease_id');
    }
}
