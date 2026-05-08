<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Incidents extends Model
{
    use HasUuids;
    protected $table = 'incidents';
    protected $guarded = [];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}