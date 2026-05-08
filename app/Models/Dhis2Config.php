<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Dhis2Config extends Model
{
    use HasUuids;
    protected $table = 'dhis2_config';
    protected $guarded = [];
}