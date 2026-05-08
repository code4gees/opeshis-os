<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NutritionStock extends Model
{
    use HasUuids;
    protected $table = 'nutrition_stock';
    protected $guarded = [];
}