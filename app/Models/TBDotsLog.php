<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TbDotsLog extends Model
{
    use HasUuids;

    protected $table = 'tb_dots_log';

    protected $fillable = [
        'case_id',
        'observed',
        'treatment_date',
        'recorded_by'
    ];

    public function case()
    {
        return $this->belongsTo(TbCase::class, 'case_id');
    }
}
