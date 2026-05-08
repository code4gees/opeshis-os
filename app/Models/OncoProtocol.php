<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OncoProtocol extends Model
{
    use HasUuids;

    protected $table = 'onco_protocols';

    protected $fillable = [
        'name',
        'description',
        'indications',
        'standard_regimen'
    ];
}
