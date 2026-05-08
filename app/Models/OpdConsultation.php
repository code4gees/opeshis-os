<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OpdConsultation extends Model
{
    use \App\Traits\ProtectsPII, \Illuminate\Database\Eloquent\Concerns\HasUuids, \App\Traits\Auditable;

    protected $table = 'opd_consultations';

    protected $fillable = [
        'encounter_id',
        'subjective',
        'objective',
        'assessment',
        'plan',
        'icd10_codes',
        'prescriptions_json',
        'procedure_notes',
        'auto_save_timestamp',
        'finalized',
        'branch_id'
    ];

    protected $casts = [
        'icd10_codes' => 'array',
        'prescriptions_json' => 'array',
        'finalized' => 'boolean',
        'auto_save_timestamp' => 'datetime'
    ];

    /**
     * Institutional PII Protection
     */
    protected function subjective(): Attribute { return $this->castPII('subjective'); }
    protected function objective(): Attribute { return $this->castPII('objective'); }
    protected function assessment(): Attribute { return $this->castPII('assessment'); }
    protected function plan(): Attribute { return $this->castPII('plan'); }
    protected function procedureNotes(): Attribute { return $this->castPII('procedure_notes'); }

    public function encounter()
    {
        return $this->belongsTo(OpdEncounter::class, 'encounter_id', 'id');
    }
}
