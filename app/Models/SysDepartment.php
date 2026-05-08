<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SysDepartment extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'description'];
}