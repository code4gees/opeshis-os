<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveillanceDisease extends Model
{
    protected $table = 'surveillance_diseases';
    protected $guarded = [];

    public function cases()
    {
        return $this->hasMany(SurveillanceCase::class, 'disease_code', 'disease_code');
    }

    public function alerts()
    {
        return $this->hasMany(SurveillanceAlert::class, 'disease_id');
    }
}
