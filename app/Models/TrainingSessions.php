<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TrainingSessions extends Model
{
    use HasUuids, \App\Traits\Auditable;
    protected $table = 'training_sessions';
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(TrainingCourses::class, 'course_id');
    }
}