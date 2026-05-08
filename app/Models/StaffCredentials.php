<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class StaffCredentials extends Model
{
    use HasUuids;
    protected $table = 'staff_credentials';
    protected $guarded = [];
}