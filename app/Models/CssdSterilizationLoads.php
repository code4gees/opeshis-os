<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CssdSterilizationLoads extends Model
{
    use HasUuids;
    protected $table = 'cssd_sterilization_loads';
    protected $guarded = [];

    public function sterilizer()
    {
        return $this->belongsTo(CssdSterilizers::class, 'sterilizer_id');
    }
}