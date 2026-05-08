<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UhcPeriods extends Model
{
    use HasUuids;
    protected $table = 'uhc_periods';
    protected $guarded = [];
}