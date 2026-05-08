<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FleetRequests extends Model
{
    use HasUuids;
    protected $table = 'fleet_requests';
    protected $guarded = [];
}