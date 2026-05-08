<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EyeRefraction extends Model
{
    use HasUuids;

    protected $table = 'eye_refractions';

    protected $fillable = [
        'eye_patient_id',
        'sphere_right',
        'cylinder_right',
        'axis_right',
        'sphere_left',
        'cylinder_left',
        'axis_left',
        'recorded_by'
    ];

    public function eyePatient()
    {
        return $this->belongsTo(EyePatient::class, 'eye_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
