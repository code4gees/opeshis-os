<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HivEmtctRecord extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'mother_id', 'test_result', 'outcome'];
}