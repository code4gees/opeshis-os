<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Dhis2Reports extends Model
{
    use HasUuids;
    protected $table = 'dhis2_reports';
    protected $guarded = [];

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}