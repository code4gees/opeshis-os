<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PerformanceReview extends Model
{
    use HasUuids;
    protected $table = 'perf_reviews';
    protected $guarded = [];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function cycle()
    {
        return $this->belongsTo(PerformanceCycle::class, 'cycle_id');
    }
}