<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HivVlRecord extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'viral_load_result', 'result_date', 'suppressed'];
}