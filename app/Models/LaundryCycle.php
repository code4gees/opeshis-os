<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LaundryCycle extends Model
{
    use HasUuids;
    protected $table = 'laundry_cycles';
    protected $guarded = [];
}
