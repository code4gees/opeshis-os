<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class MessageQueue extends Model
{
    use HasUuids;
    protected $table = 'message_queue';
    protected $guarded = [];

    public function provider()
    {
        return $this->belongsTo(MessagingProviders::class, 'provider_id');
    }
}