<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TrainingCertifications extends Model
{
    use HasUuids, \App\Traits\Auditable;
    protected $table = 'training_certifications';
    protected $guarded = [];
}