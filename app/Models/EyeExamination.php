<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EyeExamination extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'eye_examinations';

    protected $fillable = [
        'eye_patient_id',
        'va_right',
        'va_left',
        'iop_right',
        'iop_left',
        'diagnosis',
        'plan',
        'recorded_by'
    ];

    protected function diagnosis(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('diagnosis'); }
    protected function plan(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('plan'); }

    public function eyePatient()
    {
        return $this->belongsTo(EyePatient::class, 'eye_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
