<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HivCase extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'enrollment_date', 'status', 'enrolled_by'];
}