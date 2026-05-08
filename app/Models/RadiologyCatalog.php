<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RadiologyCatalog extends Model
{
    use HasUuids;
    protected $table = 'sys_radiology_catalog';
    protected $guarded = [];
}