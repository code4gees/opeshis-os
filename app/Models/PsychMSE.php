<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PsychMSE extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'psych_mse_logs';

    protected $fillable = [
        'psych_patient_id',
        'appearance',
        'behaviour',
        'speech',
        'mood',
        'affect',
        'thought_form',
        'thought_content',
        'perception',
        'cognition',
        'insight',
        'judgement',
        'recorded_by'
    ];

    protected function appearance(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('appearance'); }
    protected function behaviour(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('behaviour'); }
    protected function speech(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('speech'); }
    protected function mood(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('mood'); }
    protected function affect(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('affect'); }
    protected function thoughtForm(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('thought_form'); }
    protected function thoughtContent(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('thought_content'); }
    protected function perception(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('perception'); }
    protected function cognition(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('cognition'); }
    protected function insight(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('insight'); }
    protected function judgement(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('judgement'); }

    public function psychPatient()
    {
        return $this->belongsTo(PsychPatient::class, 'psych_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
