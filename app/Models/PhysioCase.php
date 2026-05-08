<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PhysioCase extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'physio_cases';

    protected $fillable = [
        'patient_id',
        'referral_diagnosis',
        'referral_source',
        'goals',
        'status',
        'outcome',
        'goal_achieved',
        'closed_at',
        'closed_by',
        'registered_by'
    ];

    protected function referralDiagnosis(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('referral_diagnosis'); }
    protected function goals(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('goals'); }
    protected function outcome(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('outcome'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function sessions()
    {
        return $this->hasMany(PhysioSession::class, 'case_id');
    }

    public function assessments()
    {
        return $this->hasMany(PhysioAssessment::class, 'case_id');
    }

    public function registrar()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function closingClinician()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }
}
