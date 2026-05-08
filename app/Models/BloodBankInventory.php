<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BloodBankInventory extends Model
{
    use HasUuids;

    protected $fillable = ['blood_group', 'units', 'status'];
}