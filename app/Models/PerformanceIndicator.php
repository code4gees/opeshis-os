<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PerformanceIndicator extends Model
{
    use HasUuids;
    protected $table = 'performance_indicators';
    protected $guarded = [];
}