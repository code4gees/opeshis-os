<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PsychMedication extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'psych_medications';

    protected $fillable = [
        'psych_patient_id',
        'drug_name',
        'dose',
        'frequency',
        'route',
        'indication',
        'start_date',
        'end_date',
        'status',
        'stop_reason',
        'prescribed_by',
        'updated_by'
    ];

    protected function indication(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('indication'); }
    protected function stopReason(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('stop_reason'); }

    public function psychPatient()
    {
        return $this->belongsTo(PsychPatient::class, 'psych_patient_id');
    }

    public function prescriber()
    {
        return $this->belongsTo(User::class, 'prescribed_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
