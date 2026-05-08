<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Ward extends Model
{
    use HasUuids;

    protected $table = 'wards';

    public function beds()
    {
        return $this->hasMany(WardBed::class, 'ward_id');
    }
}
