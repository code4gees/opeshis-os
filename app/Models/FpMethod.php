<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FpMethod extends Model
{
    use HasUuids;

    protected $table = 'fp_methods';
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(FpClient::class, 'client_id');
    }
}
