<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WarehouseLedger extends Model
{
    use HasUuids;
    protected $table = 'warehouse_ledger';
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(WarehouseStock::class, 'warehouse_item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}