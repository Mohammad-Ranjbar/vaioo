<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Pagination\LengthAwarePaginator;

class MessageService
{
    /**
     * Send a new message (thread starter).
     */
    public function sendMessage($sender, $receiver, string $subject, string $content): Message
    {
        return Message::create([
            'sender_id' => $sender->id,
            'sender_type' => $sender->getMorphClass(),
            'receiver_id' => $receiver->id,
            'receiver_type' => $receiver->getMorphClass(),
            'type' => 'regular',
            'subject' => $subject,
            'message' => $content,
            'read' => false,
            'read_at' => null,
        ]);
    }

    /**
     * Send a reply to an existing message.
     */
    public function sendReply(Message $originalMessage, $sender, $receiver, string $content, string $subject = null): Message
    {
        $subject = $subject ?: "RE: {$originalMessage->subject}";

        return Message::create([
            'sender_id' => $sender->id,
            'sender_type' => $sender->getMorphClass(),
            'receiver_id' => $receiver->id,
            'receiver_type' => $receiver->getMorphClass(),
            'parent_id' => $originalMessage->threadStarter()->id,
            'type' => 'reply',
            'original_subject' => $originalMessage->subject,
            'subject' => $subject,
            'message' => $content,
            'read' => false,
            'read_at' => null,
        ]);
    }

    /**
     * Get conversation thread.
     */
    public function getThread(Message $message)
    {
        return $message->thread();
    }

    /**
     * Get paginated thread.
     */
    public function getPaginatedThread(Message $message, $perPage = 15)
    {
        $threadStarter = $message->threadStarter();

        return Message::where(function($query) use ($threadStarter) {
            $query->where('id', $threadStarter->id)
                ->orWhere('parent_id', $threadStarter->id);
        })
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);
    }

    /**
     * Get threads for a user.
     */
    public function getUserThreads($user, $perPage = 15)
    {
        return Message::threadsForUser($user)->paginate($perPage);
    }

    /**
     * Get thread with latest reply first.
     */
    public function getUserThreadsWithLatest($user, $perPage = 15)
    {
        $threads = Message::threadsForUser($user)->get();

        // Add latest reply info to each thread
        $threads->each(function($thread) {
            $latestReply = $thread->latestReply();
            $thread->latest_reply = $latestReply;
            $thread->reply_count = $thread->replyCount();
            $thread->has_unread = $thread->replies()->where('read', false)->exists();
        });

        // Sort by latest activity
        $sortedThreads = $threads->sortByDesc(function($thread) {
            if ($thread->latest_reply) {
                return $thread->latest_reply->created_at;
            }
            return $thread->created_at;
        });

        // Paginate manually
        $page = request()->get('page', 1);
        $perPage = $perPage;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            $sortedThreads->slice($offset, $perPage)->values(),
            $sortedThreads->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    /**
     * Get unread messages count for an entity.
     */
    public function getUnreadCount($entity): int
    {
        return Message::where('receiver_id', $entity->id)
            ->where('receiver_type', $entity->getMorphClass())
            ->where('read', false)
            ->count();
    }

    /**
     * Get unread threads count for a user.
     */
    public function getUnreadThreadsCount($user): int
    {
        return Message::unreadThreadsCount($user)->count();
    }

    /**
     * Mark thread as read.
     */
    public function markThreadAsRead(Message $message, $user): int
    {
        return $message->markThreadAsRead($user);
    }

    /**
     * Get message statistics for an entity.
     */
    public function getStatistics($entity): array
    {
        $totalReceived = Message::where('receiver_id', $entity->id)
            ->where('receiver_type', $entity->getMorphClass())
            ->count();

        $unread = $this->getUnreadCount($entity);

        $totalSent = Message::where('sender_id', $entity->id)
            ->where('sender_type', $entity->getMorphClass())
            ->count();

        $threadsCount = Message::threadsForUser($entity)->count();
        $unreadThreadsCount = $this->getUnreadThreadsCount($entity);

        return [
            'total_received' => $totalReceived,
            'unread' => $unread,
            'sent' => $totalSent,
            'threads' => $threadsCount,
            'unread_threads' => $unreadThreadsCount,
            'read' => $totalReceived - $unread
        ];
    }
}
