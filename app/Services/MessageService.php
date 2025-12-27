<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Pagination\LengthAwarePaginator;

class MessageService
{
    public function sendMessage($sender, $receiver, string $subject, string $content): Message
    {
        return Message::query()->create([
            'sender_id' => $sender->id,
            'sender_type' => $sender->getMorphClass(),
            'receiver_id' => $receiver->id,
            'receiver_type' => $receiver->getMorphClass(),
            'subject' => $subject,
            'message' => $content,
            'read' => false,
            'read_at' => null,
        ]);
    }

    public function getConversation($entity1, $entity2, $perPage = null)
    {
        $query = Message::conversationBetween($entity1, $entity2)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc');

        if ($perPage) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function markConversationAsRead($sender, $receiver): int
    {
        return Message::query()->where('sender_id', $sender->id)
            ->where('sender_type', $sender->getMorphClass())
            ->where('receiver_id', $receiver->id)
            ->where('receiver_type', $receiver->getMorphClass())
            ->where('read', false)
            ->update([
                'read' => true,
                'read_at' => now(),
            ]);
    }


    public function getUnreadMessages($entity, $perPage = 15): LengthAwarePaginator
    {
        return Message::query()->where('receiver_id', $entity->id)
            ->where('receiver_type', $entity->getMorphClass())
            ->where('read', false)
            ->with(['sender'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getAllMessages($entity, $perPage = 15): LengthAwarePaginator
    {
        return Message::query()->where(function ($query) use ($entity) {
            $query->where('receiver_id', $entity->id)
                ->where('receiver_type', $entity->getMorphClass());
        })
            ->orWhere(function ($query) use ($entity) {
                $query->where('sender_id', $entity->id)
                    ->where('sender_type', $entity->getMorphClass());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function markAsReadById($messageId, $receiver): bool
    {
        $message = Message::query()->where('id', $messageId)
            ->where('receiver_id', $receiver->id)
            ->where('receiver_type', $receiver->getMorphClass())
            ->first();

        if ($message && !$message->read) {
            return $message->markAsRead();
        }

        return false;
    }

    public function markAllAsRead($entity): int
    {
        return Message::query()->where('receiver_id', $entity->id)
            ->where('receiver_type', $entity->getMorphClass())
            ->where('read', false)
            ->update([
                'read' => true,
                'read_at' => now(),
            ]);
    }

    public function getStatistics($entity): array
    {
        $totalReceived = Message::query()->where('receiver_id', $entity->id)
            ->where('receiver_type', $entity->getMorphClass())
            ->count();

        $unread = $this->getUnreadCount($entity);

        $totalSent = Message::query()->where('sender_id', $entity->id)
            ->where('sender_type', $entity->getMorphClass())
            ->count();

        return [
            'total_received' => $totalReceived,
            'unread' => $unread,
            'sent' => $totalSent,
            'read' => $totalReceived - $unread
        ];
    }

    public function getUnreadCount($entity): int
    {
        return Message::query()->where('receiver_id', $entity->id)
            ->where('receiver_type', $entity->getMorphClass())
            ->where('read', false)
            ->count();
    }

    public function searchMessages($entity, string $search, $perPage = 15)
    {
        return Message::query()->where(function ($query) use ($entity, $search) {
            $query->where('receiver_id', $entity->id)
                ->where('receiver_type', $entity->getMorphClass())
                ->where(function ($subQuery) use ($search) {
                    $subQuery->where('subject', 'LIKE', "%{$search}%")
                        ->orWhere('message', 'LIKE', "%{$search}%");
                });
        })
            ->orWhere(function ($query) use ($entity, $search) {
                $query->where('sender_id', $entity->id)
                    ->where('sender_type', $entity->getMorphClass())
                    ->where(function ($subQuery) use ($search) {
                        $subQuery->where('subject', 'LIKE', "%{$search}%")
                            ->orWhere('message', 'LIKE', "%{$search}%");
                    });
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
