<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TrainingNeeds extends Model
{
    use HasUuids, \App\Traits\Auditable;
    protected $table = 'training_needs';
    protected $guarded = [];
}