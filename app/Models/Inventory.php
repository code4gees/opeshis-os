<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Inventory extends Model
{
    use HasUuids;

    protected $table = 'inventory';

    public function formulary()
    {
        return $this->belongsTo(DrugFormulary::class, 'formulary_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'inventory_id');
    }
}
