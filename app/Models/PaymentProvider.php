<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PaymentProvider extends Model
{
    use HasUuids;

    protected $fillable = ['provider_name', 'credentials', 'status'];
}