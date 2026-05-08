<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UhcResults extends Model
{
    use HasUuids;
    protected $table = 'uhc_results';
    protected $guarded = [];
}