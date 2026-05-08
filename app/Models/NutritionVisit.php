<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NutritionVisit extends Model
{
    use HasUuids;

    protected $table = 'nutrition_visits';
    protected $guarded = [];

    public function case()
    {
        return $this->belongsTo(NutritionCase::class, 'case_id');
    }
}
