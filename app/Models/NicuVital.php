<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NicuVital extends Model
{
    use HasUuids, \App\Traits\Auditable, \App\Traits\ProtectsPII;

    protected $table = 'nicu_vitals';
    protected $guarded = [];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }
}
