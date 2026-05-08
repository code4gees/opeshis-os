<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DialysisPatient extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'dialysis_patients';

    protected $fillable = [
        'patient_id',
        'access_type',
        'dry_weight',
        'frequency',
        'diagnosis',
        'status',
        'dry_weight_updated_at',
        'registered_by'
    ];

    protected function diagnosis(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('diagnosis'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function sessions()
    {
        return $this->hasMany(DialysisSession::class, 'dialysis_patient_id');
    }

    public function pdSessions()
    {
        return $this->hasMany(DialysisPdSession::class, 'dialysis_patient_id');
    }

    public function labHistory()
    {
        return $this->hasMany(DialysisLab::class, 'dialysis_patient_id');
    }

    public function activeSession()
    {
        return $this->hasOne(DialysisSession::class, 'dialysis_patient_id')->where('status', 'in_progress');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }
}
