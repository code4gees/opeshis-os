<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class StockRequisitions extends Model
{
    use HasUuids;
    protected $table = 'stock_requisitions';
    protected $guarded = [];

    public function pharmacyItem()
    {
        return $this->belongsTo(Inventory::class, 'pharmacy_item_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function warehouseItem()
    {
        return $this->belongsTo(WarehouseStock::class, 'warehouse_item_id');
    }
}