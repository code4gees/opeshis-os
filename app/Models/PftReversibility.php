<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PftReversibility extends Model
{
    use HasUuids;

    protected $table = 'pft_reversibility';
    protected $guarded = [];

    public function session()
    {
        return $this->belongsTo(PftSession::class, 'session_id');
    }
}
