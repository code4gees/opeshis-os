<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PftSession extends Model
{
    use HasUuids;

    protected $fillable = ['patient_id', 'indication', 'created_by'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}