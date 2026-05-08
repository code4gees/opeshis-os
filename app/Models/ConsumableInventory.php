<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ConsumableInventory extends Model
{
    use HasUuids;
    protected $table = 'consumable_inventory';
    protected $guarded = [];
}