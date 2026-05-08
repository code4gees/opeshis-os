<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DialysisMachine extends Model
{
    use HasUuids;

    protected $table = 'dialysis_machines';

    protected $fillable = [
        'serial_number',
        'model',
        'status',
        'last_service_date'
    ];

    public function sessions()
    {
        return $this->hasMany(DialysisSession::class, 'machine_id');
    }
}
