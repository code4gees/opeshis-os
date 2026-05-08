<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NutritionCase extends Model
{
    use HasUuids;

    protected $table = 'nutrition_cases';
    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function visits()
    {
        return $this->hasMany(NutritionVisit::class, 'case_id');
    }
}
