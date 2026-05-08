<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EyeSurgery extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'eye_surgeries';

    protected $fillable = [
        'eye_patient_id',
        'procedure',
        'eye_side',
        'scheduled_date',
        'status',
        'operative_notes',
        'surgeon_id',
        'completed_at'
    ];

    protected function operativeNotes(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('operative_notes'); }

    public function eyePatient()
    {
        return $this->belongsTo(EyePatient::class, 'eye_patient_id');
    }

    public function surgeon()
    {
        return $this->belongsTo(User::class, 'surgeon_id');
    }
}
