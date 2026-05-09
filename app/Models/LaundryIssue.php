<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LaundryIssue extends Model
{
    use HasUuids;
    protected $table = 'laundry_issues';
    protected $guarded = [];
}
