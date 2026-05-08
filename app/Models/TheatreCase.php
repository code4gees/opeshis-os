<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TheatreCase extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'theatre_cases';

    protected $fillable = [
        'patient_id',
        'scheduled_date',
        'procedure_name',
        'status',
        'asa_grade',
        'airway_assessment',
        'fasting_status',
        'preop_notes',
        'preop_done',
        'preop_by',
        'preop_at',
        'started_at',
        'checklist',
        'checklist_verified_by',
        'checklist_at'
    ];

    protected $casts = [
        'checklist' => 'array',
        'preop_done' => 'boolean',
    ];

    protected function procedureName(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('procedure_name'); }
    protected function preopNotes(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('preop_notes'); }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function intraop()
    {
        return $this->hasOne(TheatreIntraop::class, 'case_id');
    }

    public function vitals()
    {
        return $this->hasMany(TheatreVital::class, 'case_id');
    }

    public function anaesthesiaDrugs()
    {
        return $this->hasMany(TheatreAnaesthesiaDrug::class, 'case_id');
    }

    public function recovery()
    {
        return $this->hasOne(TheatreRecovery::class, 'case_id');
    }

    public function preopAssessor()
    {
        return $this->belongsTo(User::class, 'preop_by');
    }
}
