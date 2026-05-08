<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class HduVital extends Model
{
    use HasUuids, \App\Traits\Auditable, \App\Traits\ProtectsPII;

    protected $table = 'hdu_vitals_log';
    protected $guarded = [];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }
}
