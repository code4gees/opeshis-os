<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PatientConsent extends Model
{
    use HasUuids;
    protected $table = 'patient_consents';
    protected $guarded = [];
}