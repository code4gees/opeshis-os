<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Vendors extends Model
{
    use HasUuids;
    protected $table = 'vendors';
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(WarehouseStock::class, 'vendor_id');
    }
}