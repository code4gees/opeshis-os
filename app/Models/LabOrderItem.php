<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LabOrderItem extends Model
{
    use HasUuids;

    public function order()
    {
        return $this->belongsTo(LabOrder::class, 'order_id');
    }

    public function test()
    {
        return $this->belongsTo(LabCatalog::class, 'test_id');
    }
}
