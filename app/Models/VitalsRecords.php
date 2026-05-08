<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class VitalsRecords extends Model
{
    use HasUuids;
    protected $table = 'vitals_records';
    protected $guarded = [];
}