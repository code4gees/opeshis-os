<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ObstetricsAdmission extends Model
{
    use HasUuids;

    protected $table = 'obstetrics_admissions';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function observations()
    {
        return $this->hasMany(ObstetricsObservation::class, 'admission_id');
    }

    public function deliveries()
    {
        return $this->hasMany(ObstetricsDelivery::class, 'admission_id');
    }
}
