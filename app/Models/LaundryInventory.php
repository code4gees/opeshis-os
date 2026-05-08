<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LaundryInventory extends Model
{
    use HasUuids;
    protected $table = 'laundry_inventory';
    protected $guarded = [];
}
