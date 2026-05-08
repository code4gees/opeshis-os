<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\ProtectsPII;

class MortuaryAdmission extends Model
{
    use HasUuids, ProtectsPII;

    protected $table = 'mortuary_admissions';
    protected $guarded = [];

    protected function deceasedName(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return $this->castPII('deceased_name');
    }

    public function slot()
    {
        return $this->belongsTo(MortuarySlot::class, 'slot_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
