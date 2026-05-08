<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WoundDressing extends Model
{
    use HasUuids;

    protected $fillable = ['wound_id', 'dressing_type', 'wound_bed', 'exudate', 'odour', 'notes', 'recorded_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}