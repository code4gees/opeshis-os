<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ConsentTemplate extends Model
{
    use HasUuids;
    protected $table = 'consent_templates';
    protected $guarded = [];
}