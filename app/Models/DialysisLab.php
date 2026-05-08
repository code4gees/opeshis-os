<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DialysisLab extends Model
{
    use HasUuids;

    protected $table = 'dialysis_labs';

    protected $fillable = [
        'dialysis_patient_id',
        'urea_pre',
        'urea_post',
        'creatinine',
        'potassium',
        'haemoglobin',
        'phosphate',
        'recorded_by'
    ];

    public function patient()
    {
        return $this->belongsTo(DialysisPatient::class, 'dialysis_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
