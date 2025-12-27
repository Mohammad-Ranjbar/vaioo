<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'family',
        'mobile',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function fullName(): Attribute
    {
        return Attribute::get(fn() => $this->getAttribute('name') . ' ' . $this->getAttribute('family'));
    }

    public function sentMessages(): MorphMany
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function conversationWithUser(User $user)
    {
        return Message::conversationBetween($this, $user)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function conversationWithRepresentative(Representative $representative)
    {
        return Message::conversationBetween($this, $representative)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function unreadMessagesCount(): int
    {
        return $this->receivedMessages()->unread()->count();
    }

    public function receivedMessages(): MorphMany
    {
        return $this->morphMany(Message::class, 'receiver');
    }

    public function messagesBySenderType(): Collection
    {
        return $this->receivedMessages()
            ->with('sender')
            ->get()
            ->groupBy(function ($message) {
                return $message->sender_type;
            });
    }
}
