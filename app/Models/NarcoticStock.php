<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NarcoticStock extends Model
{
    use HasUuids, \App\Traits\Auditable;

    protected $table = 'narcotics_register';
    protected $guarded = [];

    public function movements()
    {
        return $this->hasMany(NarcoticMovement::class, 'stock_id');
    }

    public function counts()
    {
        return $this->hasMany(NarcoticStockCount::class, 'stock_id');
    }
}
