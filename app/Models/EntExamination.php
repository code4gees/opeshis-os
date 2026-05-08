<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EntExamination extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'ent_examinations';

    protected $fillable = [
        'ent_patient_id',
        'ear_findings',
        'nose_findings',
        'throat_findings',
        'diagnosis',
        'plan',
        'recorded_by'
    ];

    protected function earFindings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('ear_findings'); }
    protected function noseFindings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('nose_findings'); }
    protected function throatFindings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('throat_findings'); }
    protected function diagnosis(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('diagnosis'); }
    protected function plan(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('plan'); }

    public function entPatient()
    {
        return $this->belongsTo(EntPatient::class, 'ent_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
