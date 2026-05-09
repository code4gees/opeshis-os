<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class StockRequisition extends Model
{
    use HasUuids;

    protected $table = 'stock_requisitions';
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Inventory::class, 'pharmacy_item_id');
    }

    public function pharmacyItem()
    {
        return $this->item();
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
