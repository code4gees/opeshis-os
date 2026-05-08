<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WarehouseStock extends Model
{
    use HasUuids;
    protected $table = 'warehouse_stock';
    protected $guarded = [];

    public function vendor()
    {
        return $this->belongsTo(Vendors::class, 'vendor_id');
    }

    public function modifier()
    {
        return $this->belongsTo(User::class, 'modified_by');
    }
}