<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MessagingProvider extends Model
{
    use HasUuids;

    protected $fillable = ['provider_name', 'api_key', 'status'];
}