<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HivArtRecord extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'regimen_code', 'start_date', 'dispensed_by'];
}