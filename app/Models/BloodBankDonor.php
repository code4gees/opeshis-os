<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BloodBankDonor extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'blood_group', 'contact'];
}