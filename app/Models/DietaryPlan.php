<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DietaryPlan extends Model
{
    use HasUuids;
    protected $table = 'dietary_plans';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function deliveries()
    {
        return $this->hasMany(KitchenDelivery::class, 'plan_id');
    }
}