<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EntAudiogram extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'ent_audiograms';

    protected $fillable = [
        'ent_patient_id',
        'right_ear_500hz',
        'right_ear_1khz',
        'right_ear_2khz',
        'right_ear_4khz',
        'left_ear_500hz',
        'left_ear_1khz',
        'left_ear_2khz',
        'left_ear_4khz',
        'interpretation',
        'recorded_by'
    ];

    protected function interpretation(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('interpretation'); }

    public function entPatient()
    {
        return $this->belongsTo(EntPatient::class, 'ent_patient_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
