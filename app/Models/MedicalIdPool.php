<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalIdPool extends Model
{
    protected $table = 'medical_id_pool';
    protected $primaryKey = 'medical_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'medical_id',
        'status',
        'patient_id',
        'assigned_at'
    ];
}
