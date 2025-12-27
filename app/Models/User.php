<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'family',
        'mobile',
        'email',
        'password',
        'mobile_verified_at',
        'is_active'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function fullname(): Attribute
    {
        return Attribute::get(function () {
            $name = $this->getAttribute('name');
            $family = $this->getAttribute('family');

            if (!empty($name) && !empty($family)) {
                return $name . ' ' . $family;
            }

            return $this->getAttribute('mobile');
        });
    }

    public function sentMessages(): MorphMany
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function receivedMessages(): MorphMany
    {
        return $this->morphMany(Message::class, 'receiver');
    }

    public function conversationWithRepresentative(Representative $representative)
    {
        return Message::conversationBetween($this, $representative)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Get conversation with a specific admin.
     */
    public function conversationWithAdmin(Admin $admin)
    {
        return Message::conversationBetween($this, $admin)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function unreadMessagesCount(): int
    {
        return $this->receivedMessages()->unread()->count();
    }

    /**
     * Get unread messages.
     */
    public function unreadMessages()
    {
        return $this->receivedMessages()->unread()->get();
    }


    protected function casts(): array
    {
        return [
            'mobile_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
