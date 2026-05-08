<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UhcIndicators extends Model
{
    use HasUuids;
    protected $table = 'uhc_indicators';
    protected $guarded = [];
}