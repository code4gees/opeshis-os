<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PhysioAssessment extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'physio_assessments';

    protected $fillable = [
        'case_id',
        'subjective',
        'objective',
        'assessment',
        'plan',
        'rom_findings',
        'strength_findings',
        'recorded_by'
    ];

    protected function subjective(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('subjective'); }
    protected function objective(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('objective'); }
    protected function assessment(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('assessment'); }
    protected function plan(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('plan'); }
    protected function romFindings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('rom_findings'); }
    protected function strengthFindings(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('strength_findings'); }

    public function physioCase()
    {
        return $this->belongsTo(PhysioCase::class, 'case_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
