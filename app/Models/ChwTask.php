<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ChwTask extends Model
{
    use HasUuids;

    protected $fillable = ['task_name', 'status', 'assigned_to'];
}