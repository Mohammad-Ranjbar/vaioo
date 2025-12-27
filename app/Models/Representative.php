<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Collection;

class Representative extends Authenticatable implements HasMedia
{

    use Notifiable, InteractsWithMedia;

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'name',
        'family',
        'national_code',
        'passport_number',
        'email',
        'email_verified_at',
        'mobile',
        'mobile_verified_at',
        'password',
        'profile_image',
        'birth_date',
        'is_active',
        'verification_status',
        'verification_rejection_reason',
        'verified_at',
        'rating_average',
        'rating_count',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('national_card_front')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg'])
            ->useDisk('public');


        $this->addMediaCollection('national_card_back')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg'])
            ->useDisk('public');

        $this->addMediaCollection('selfie_with_card')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg'])
            ->useDisk('public');
    }

    public function getDocumentUrl(string $collectionName): ?string
    {
        $media = $this->getFirstMedia($collectionName);
        return $media?->getUrl() ?? null;
    }

    public function hasDocument(string $collectionName): bool
    {
        return $this->hasMedia($collectionName);
    }

    public function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }

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

    public function imageUrl(): Attribute
    {
        return Attribute::get(fn() => asset('storage/' . $this->getAttribute('profile_image')));
    }

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

    public function receivedMessages(): MorphMany
    {
        return $this->morphMany(Message::class, 'receiver');
    }

    public function contactedUsers(): Collection
    {
        $userIds = $this->sentMessages()
            ->where('receiver_type', User::class)
            ->pluck('receiver_id')
            ->merge(
                $this->receivedMessages()
                    ->where('sender_type', User::class)
                    ->pluck('sender_id')
            )
            ->unique();

        return User::query()->whereIn('id', $userIds)->get();
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
}
