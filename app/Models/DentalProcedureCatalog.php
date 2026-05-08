<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DentalProcedureCatalog extends Model
{
    use HasUuids;
    protected $table = 'dental_procedure_catalog';
    protected $guarded = [];
}