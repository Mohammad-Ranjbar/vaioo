<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Services\MessageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct(private readonly MessageService $messageService)
    {

    }

    public function index(Request $request): Factory|View
    {
        $user = Auth::user();
        $type = $request->get('type', 'all');

        // Get messages based on type
        switch ($type) {
            case 'inbox':
                $messages = Message::where('receiver_id', $user->id)
                    ->where('receiver_type', $user->getMorphClass())
                    ->with(['sender'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                $received_count = $messages->total();
                $sent_count = Message::where('sender_id', $user->id)
                    ->where('sender_type', $user->getMorphClass())
                    ->count();
                break;

            case 'sent':
                $messages = Message::where('sender_id', $user->id)
                    ->where('sender_type', $user->getMorphClass())
                    ->with(['receiver'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                $sent_count = $messages->total();
                $received_count = Message::where('receiver_id', $user->id)
                    ->where('receiver_type', $user->getMorphClass())
                    ->count();
                break;

            case 'unread':
                $messages = Message::where('receiver_id', $user->id)
                    ->where('receiver_type', $user->getMorphClass())
                    ->where('read', false)
                    ->with(['sender'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                $received_count = Message::where('receiver_id', $user->id)
                    ->where('receiver_type', $user->getMorphClass())
                    ->count();
                $sent_count = Message::where('sender_id', $user->id)
                    ->where('sender_type', $user->getMorphClass())
                    ->count();
                break;

            default: // all
                $messages = Message::where(function ($query) use ($user) {
                    $query->where('receiver_id', $user->id)
                        ->where('receiver_type', $user->getMorphClass());
                })
                    ->orWhere(function ($query) use ($user) {
                        $query->where('sender_id', $user->id)
                            ->where('sender_type', $user->getMorphClass());
                    })
                    ->with(['sender', 'receiver'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                $received_count = Message::where('receiver_id', $user->id)
                    ->where('receiver_type', $user->getMorphClass())
                    ->count();
                $sent_count = Message::where('sender_id', $user->id)
                    ->where('sender_type', $user->getMorphClass())
                    ->count();
                break;
        }

        $unread_count = $this->messageService->getUnreadCount($user);
        $total_count = $received_count + $sent_count;

        return view('panel.user-panel.messages.index', compact('messages', 'unread_count', 'total_count', 'type', 'sent_count'));
    }


    public function show($id)
    {
        $user = Auth::user();

        $message = Message::where(function($query) use ($user, $id) {
            $query->where('id', $id)
                ->where(function($q) use ($user) {
                    $q->where('receiver_id', $user->id)
                        ->where('receiver_type', $user->getMorphClass())
                        ->orWhere(function($sub) use ($user) {
                            $sub->where('sender_id', $user->id)
                                ->where('sender_type', $user->getMorphClass());
                        });
                });
        })
            ->with(['sender', 'receiver'])
            ->firstOrFail();

        // Get thread messages
        $thread = $this->messageService->getThread($message);

        // Mark all messages in thread as read for this user
        $this->messageService->markThreadAsRead($message, $user);

        return view('panel.user.messages.show', compact('message', 'thread'));
    }

}
