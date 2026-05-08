<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FleetVehicles extends Model
{
    use HasUuids;
    protected $table = 'fleet_vehicles';
    protected $guarded = [];
}