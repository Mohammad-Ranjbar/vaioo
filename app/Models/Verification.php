<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Verification extends Model
{
    const array CHANNELS =[
        'sms',
        'email'
    ];
    protected $fillable = [
        'authenticatable_type', 'authenticatable_id',
        'channel', 'identifier', 'otp_hash', 'expires_at', 'used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    public function authenticatable(): MorphTo
    {
        return $this->morphTo();
    }

    public function isExpired(): bool
    {
        return $this->getAttribute('expires_at')->isPast();
    }

    public function markAsUsed(): bool
    {
        return $this->update(['used' => true]);
    }
}
