<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TheatreRecovery extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'theatre_recovery';

    protected $fillable = [
        'case_id',
        'arrival_time',
        'aldrete_score',
        'pain_score',
        'nausea',
        'discharge_time',
        'current_status',
        'notes',
        'recorded_by',
        'updated_by'
    ];

    protected $casts = [
        'nausea' => 'boolean',
    ];

    protected function notes(): \Illuminate\Database\Eloquent\Casts\Attribute { return $this->castPII('notes'); }

    public function case()
    {
        return $this->belongsTo(TheatreCase::class, 'case_id');
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
