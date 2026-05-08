<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CssdSterilizers extends Model
{
    use HasUuids;
    protected $table = 'cssd_sterilizers';
    protected $guarded = [];
}