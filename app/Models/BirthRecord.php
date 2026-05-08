<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BirthRecord extends Model
{
    use HasUuids, \App\Traits\ProtectsPII;

    protected $table = 'birth_records';

    protected $fillable = [
        'mother_id',
        'baby_name',
        'gender',
        'birth_datetime',
        'weight_kg',
        'delivery_type',
        'attending_clinician_id'
    ];

    protected function babyName(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return $this->castPII('baby_name');
    }

    public function mother()
    {
        return $this->belongsTo(Patient::class, 'mother_id');
    }

    public function clinician()
    {
        return $this->belongsTo(User::class, 'attending_clinician_id');
    }
}
