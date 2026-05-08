<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MedicalTerm extends Model
{
    use HasUuids;
    protected $table = 'sys_medical_terms';
    protected $guarded = [];
}