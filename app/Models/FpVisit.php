<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FpVisit extends Model
{
    use HasUuids;

    protected $table = 'fp_visits';
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(FpClient::class, 'client_id');
    }
}
