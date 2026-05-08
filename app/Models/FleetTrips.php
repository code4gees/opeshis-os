<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FleetTrips extends Model
{
    use HasUuids;
    protected $table = 'fleet_trips';
    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(FleetVehicles::class, 'vehicle_id');
    }
}