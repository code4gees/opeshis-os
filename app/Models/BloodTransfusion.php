<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BloodTransfusion extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'blood_group', 'units', 'status'];
}