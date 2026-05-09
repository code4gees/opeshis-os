<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MaintenanceSchedule extends Model
{
    use HasUuids;
    protected $table = 'maintenance_schedules';
    protected $guarded = [];
}
