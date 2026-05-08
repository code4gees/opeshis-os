<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ObstetricsDelivery extends Model
{
    use HasUuids, \App\Traits\Auditable, \App\Traits\ProtectsPII;

    protected $table = 'obstetrics_deliveries';
    protected $guarded = [];

    public function admission()
    {
        return $this->belongsTo(Admission::class, 'admission_id');
    }
}
