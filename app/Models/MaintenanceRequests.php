<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MaintenanceRequests extends Model
{
    use HasUuids;
    protected $table = 'maintenance_work_orders';
    protected $guarded = [];

    public function technician()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function raisedBy()
    {
        return $this->belongsTo(User::class, 'raised_by');
    }
}