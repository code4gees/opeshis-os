<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PerformanceSelfAssessment extends Model
{
    use HasUuids;
    protected $table = 'perf_self_assessments';
    protected $guarded = [];
}