<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PerformanceCycle extends Model
{
    use HasUuids;
    protected $table = 'perf_cycles';
    protected $guarded = [];
}