<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FleetFuel extends Model
{
    use HasUuids;
    protected $table = 'fleet_fuel';
    protected $guarded = [];
}