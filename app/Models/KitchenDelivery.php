<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class KitchenDelivery extends Model
{
    use HasUuids;
    protected $table = 'kitchen_deliveries';
    protected $guarded = [];
}