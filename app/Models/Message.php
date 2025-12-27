<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{

    protected $fillable = [
        'subject',
        'message',
        'read',
        'read_at',
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
    ];

    protected $casts = [
        'read' => 'boolean',
        'read_at' => 'datetime',
    ];


    public function sender(): MorphTo
    {
        return $this->morphTo();
    }

    public function receiver(): MorphTo
    {
        return $this->morphTo();
    }


    public function scopeUnread($query)
    {
        return $query->where('read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('read', true);
    }

    public function markAsRead(): void
    {
        if (!$this->getAttribute('read')) {
            $this->update([
                'read' => true,
                'read_at' => now(),
            ]);
        }
    }

    public function markAsUnread(): void
    {
        $this->update([
            'read' => false,
            'read_at' => null,
        ]);
    }

    public function sentMessages(): MorphMany
    {
        return $this->morphMany(Message::class, 'sender');
    }

    public function receivedMessages(): MorphMany
    {
        return $this->morphMany(Message::class, 'receiver');
    }

    public function scopeSentBy($query, $model)
    {
        return $query->where('sender_id', $model->id)
            ->where('sender_type', $model->getMorphClass());
    }

    public function scopeReceivedBy($query, $model)
    {
        return $query->where('receiver_id', $model->id)
            ->where('receiver_type', $model->getMorphClass());
    }

    public function scopeConversationBetween($query, $entity1, $entity2)
    {
        return $query->where(function ($q) use ($entity1, $entity2) {
            $q->where(function ($sub) use ($entity1, $entity2) {
                $sub->where('sender_id', $entity1->id)
                    ->where('sender_type', $entity1->getMorphClass())
                    ->where('receiver_id', $entity2->id)
                    ->where('receiver_type', $entity2->getMorphClass());
            })->orWhere(function ($sub) use ($entity1, $entity2) {
                $sub->where('sender_id', $entity2->id)
                    ->where('sender_type', $entity2->getMorphClass())
                    ->where('receiver_id', $entity1->id)
                    ->where('receiver_type', $entity1->getMorphClass());
            });
        });
    }

    public function isSentBy($entity): bool
    {
        return $this->getAttribute('sender_id') === $entity->id &&
            $this->getAttribute('sender_type') === $entity->getMorphClass();
    }

    public function isReceivedBy($entity): bool
    {
        return $this->getAttribute('receiver_id') === $entity->id &&
            $this->getAttribute('receiver_type') === $entity->getMorphClass();
    }
}
