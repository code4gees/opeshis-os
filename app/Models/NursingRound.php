<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class NursingRound extends Model
{
    use HasUuids;

    protected $fillable = [
        'admission_id',
        'staff_id',
        'scheduled_at',
        'completed_at',
        'task_type',
        'status',
        'notes'
    ];

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function vitals()
    {
        return $this->hasOne(VitalsRecord::class, 'round_id');
    }
}
