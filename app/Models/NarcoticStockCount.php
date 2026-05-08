<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NarcoticStockCount extends Model
{
    use HasUuids, \App\Traits\Auditable;

    protected $table = 'narcotics_stock_counts';
    protected $guarded = [];

    public function stock()
    {
        return $this->belongsTo(NarcoticStock::class, 'stock_id');
    }
}
