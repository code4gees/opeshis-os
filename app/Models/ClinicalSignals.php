<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ClinicalSignals extends Model
{
    use HasUuids;
    protected $table = 'clinical_signals';
    protected $guarded = [];
}