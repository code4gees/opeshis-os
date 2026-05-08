<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SysAsset extends Model
{
    use HasUuids;

    protected $fillable = ['asset_name', 'serial_number', 'status', 'next_maintenance_date'];
}