<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MortuarySlot extends Model
{
    use HasUuids;

    protected $table = 'mortuary_slots';
    protected $guarded = [];

    public function admissions()
    {
        return $this->hasMany(MortuaryAdmission::class, 'slot_id');
    }

    public function currentAdmission()
    {
        return $this->hasOne(MortuaryAdmission::class, 'slot_id')->where('status', 'admitted');
    }
}
