<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DietaryPlans extends Model
{
    use HasUuids;
    protected $table = 'dietary_plans';
    protected $guarded = [];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }

    public function deliveries()
    {
        return $this->hasMany(KitchenDeliveries::class, 'plan_id');
    }
}