<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TbCase extends Model
{
    use HasUuids;

    protected $fillable = [
        'patient_id',
        'tb_type',
        'regimen',
        'sputum_result',
        'registered_by'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
