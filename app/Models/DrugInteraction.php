<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DrugInteraction extends Model
{
    use HasUuids;
    protected $table = 'sys_drug_interactions';
    protected $guarded = [];
}