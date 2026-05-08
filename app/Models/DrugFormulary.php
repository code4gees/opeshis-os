<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DrugFormulary extends Model
{
    use HasUuids;

    protected $table = 'sys_drug_formulary';

    public function inventoryItems()
    {
        return $this->hasMany(Inventory::class, 'formulary_id');
    }
}
