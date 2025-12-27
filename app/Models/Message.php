<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Pagination\LengthAwarePaginator;

class Message extends Model
{
    protected $fillable = [
        'subject',
        'message',
        'read',
        'read_at',
        'parent_id',
        'type',
        'original_subject',
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
    ];

    protected $casts = [
        'read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    public function paginatedReplies($perPage = 10): LengthAwarePaginator
    {
        return $this->replies()->paginate($perPage);
    }

    public function threadStarter()
    {
        if (!$this->getAttribute('parent_id')) {
            return $this;
        }

        return $this->parent->threadStarter();
    }

    public function thread()
    {
        $threadStarter = $this->threadStarter();

        return Message::query()->where(function($query) use ($threadStarter) {
            $query->where('id', $threadStarter->id)
                ->orWhere('parent_id', $threadStarter->id);
        })->orderBy('created_at', 'asc')->get();
    }

    public function hasReplies(): bool
    {
        return $this->replies()->exists();
    }

    /**
     * Get the latest reply.
     */
    public function latestReply()
    {
        return $this->replies()->latest()->first();
    }

    public function replyCount(): int
    {
        return $this->replies()->count();
    }

    /**
     * Check if message is a reply.
     */
    public function isReply(): bool
    {
        return $this->parent_id !== null;
    }
    public function isFirstMessage(): bool
    {
        return $this->parent_id === null;
    }

    public function createReply($sender, $receiver, $content, $subject = null): Message
    {
        $subject = $subject ?: "RE: {$this->subject}";

        return Message::create([
            'sender_id' => $sender->id,
            'sender_type' => $sender->getMorphClass(),
            'receiver_id' => $receiver->id,
            'receiver_type' => $receiver->getMorphClass(),
            'parent_id' => $this->id,
            'type' => 'reply',
            'original_subject' => $this->subject,
            'subject' => $subject,
            'message' => $content,
            'read' => false,
            'read_at' => null,
        ]);
    }

    public function scopeThreadStarters($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeReplies($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeReceivedBy($query, $model)
    {
        return $query->where('receiver_id', $model->id)
            ->where('receiver_type', $model->getMorphClass());
    }

    public function scopeThreadsForUser($query, $user)
    {
        return $query->where(function($q) use ($user) {
            $q->where('sender_id', $user->id)
                ->where('sender_type', $user->getMorphClass())
                ->orWhere('receiver_id', $user->id)
                ->where('receiver_type', $user->getMorphClass());
        })
            ->whereNull('parent_id') // Only thread starters
            ->orderBy('created_at', 'desc');
    }

    public function scopeUnreadThreadsCount($query, $user)
    {
        return $query->whereNull('parent_id')
            ->where(function($q) use ($user) {
                $q->where('receiver_id', $user->id)
                    ->where('receiver_type', $user->getMorphClass())
                    ->where('read', false);
            });
    }

    public function markThreadAsRead($user): int
    {
        $threadStarter = $this->threadStarter();

        return Message::query()->where(function($query) use ($threadStarter) {
            $query->where('id', $threadStarter->id)
                ->orWhere('parent_id', $threadStarter->id);
        })
            ->where('receiver_id', $user->id)
            ->where('receiver_type', $user->getMorphClass())
            ->where('read', false)
            ->update([
                'read' => true,
                'read_at' => now(),
            ]);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Message::class, 'parent_id')->orderBy('created_at');
    }

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
