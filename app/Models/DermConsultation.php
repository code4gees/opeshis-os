<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DermConsultation extends Model
{
    use HasUuids;

    protected $fillable = ['derm_patient_id', 'skin_findings', 'body_area', 'treatment', 'recorded_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}