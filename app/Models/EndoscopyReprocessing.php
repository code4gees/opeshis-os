<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EndoscopyReprocessing extends Model
{
    use HasUuids;

    protected $table = 'endoscopy_reprocessing_logs';

    protected $fillable = [
        'scope_id',
        'cycle_type',
        'disinfectant',
        'passed_test',
        'recorded_by'
    ];

    public function clinician()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
