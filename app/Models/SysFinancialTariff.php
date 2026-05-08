<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SysFinancialTariff extends Model
{
    use HasUuids;

    protected $fillable = ['service_name', 'price', 'category'];
}