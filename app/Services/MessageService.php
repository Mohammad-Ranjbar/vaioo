<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public static function sendMessage($sender, $receiver, string $subject, string $content): Message
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

    public static function getConversation($entity1, $entity2)
    {
        return Message::conversationBetween($entity1, $entity2)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public static function markConversationAsRead($sender, $receiver): int
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

    public static function getUnreadCount($entity): int
    {
        return Message::query()->where('receiver_id', $entity->id)
            ->where('receiver_type', $entity->getMorphClass())
            ->where('read', false)
            ->count();
    }
}
