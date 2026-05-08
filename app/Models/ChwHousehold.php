<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ChwHousehold extends Model
{
    use HasUuids;

    protected $fillable = ['head_name', 'location', 'size'];
}