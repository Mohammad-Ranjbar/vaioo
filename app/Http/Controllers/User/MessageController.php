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

        $message = Message::query()->where(function($query) use ( $id) {
            $query->where('id', $id)
                ->where(function($q) {
                    $q->where('receiver_id', Auth::id())
                        ->where('receiver_type', User::class)
                        ->orWhere(function($sub)  {
                            $sub->where('sender_id', Auth::id())
                                ->where('sender_type', User::class);
                        });
                });
        })
            ->with(['sender', 'receiver'])
            ->firstOrFail();

        $thread = $this->messageService->getThread($message);

        $this->messageService->markThreadAsRead($message, Auth::user());

        return view('panel.user-panel.messages.show', compact('message', 'thread'));
    }

    public function storeReply(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:1',
            'original_subject' => 'sometimes|string|max:255'
        ]);

        $user = Auth::user();

        try {
            // Find the message being replied to
            $originalMessage = Message::where('id', $id)
                ->where(function($query) use ($user) {
                    $query->where('sender_id', $user->id)
                        ->where('sender_type', $user->getMorphClass())
                        ->orWhere(function($q) use ($user) {
                            $q->where('receiver_id', $user->id)
                                ->where('receiver_type', $user->getMorphClass());
                        });
                })
                ->firstOrFail();

            // Determine who should receive the reply
            if ($originalMessage->sender_id == $user->id) {
                // User is replying to their own message (should go to original receiver)
                $receiver = $originalMessage->receiver;
            } else {
                // User is replying to a message they received (should go to original sender)
                $receiver = $originalMessage->sender;
            }

            // Use the thread starter for parent_id (always reply to the thread starter)
            $threadStarter = $originalMessage->threadStarter();

            // Create the reply using MessageService
            $reply = $this->messageService->sendReply(
                $threadStarter,
                $user,
                $receiver,
                $request->message,
                $request->subject
            );

            // Optionally send notification to receiver
            $this->sendReplyNotification($reply, $receiver);

            return redirect()->route('user.messages.show', $threadStarter->id)
                ->with('success', 'پاسخ شما با موفقیت ارسال شد.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('user.messages.index')
                ->with('error', 'پیام مورد نظر یافت نشد.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'خطا در ارسال پاسخ. لطفاً مجدد تلاش کنید.');
        }
    }

    private function sendReplyNotification(Message $reply, $receiver)
    {
        // You can implement notification logic here
        // Example: Send email notification, push notification, etc.

        // Example email notification (using Laravel Notifications):
        // $receiver->notify(new NewMessageNotification($reply));

        // Example database notification:
        // DB::table('notifications')->insert([
        //     'type' => 'new_message',
        //     'notifiable_id' => $receiver->id,
        //     'notifiable_type' => get_class($receiver),
        //     'data' => json_encode([
        //         'message_id' => $reply->id,
        //         'sender_name' => $reply->sender->name ?? $reply->sender->email,
        //         'subject' => $reply->subject,
        //         'preview' => Str::limit($reply->message, 100)
        //     ]),
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
    }


    public function markAsRead($id)
    {
        $user = Auth::user();

        try {
            // Find the message (user must be the receiver)
            $message = Message::where('id', $id)
                ->where('receiver_id', $user->id)
                ->where('receiver_type', $user->getMorphClass())
                ->firstOrFail();

            // Mark the message as read
            $result = $message->markAsRead();

            if ($result) {
                // If this is a thread starter, also mark all replies as read
                if ($message->parent_id === null) {
                    $this->messageService->markThreadAsRead($message, $user);

                    return response()->json([
                        'success' => true,
                        'message' => 'پیام و تمام پاسخ‌های آن با موفقیت خوانده شدند.',
                        'data' => [
                            'message_id' => $message->id,
                            'read' => true,
                            'read_at' => $message->read_at
                        ]
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'پیام با موفقیت خوانده شد.',
                    'data' => [
                        'message_id' => $message->id,
                        'read' => true,
                        'read_at' => $message->read_at
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'پیام قبلاً خوانده شده است.'
            ], 400);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'پیام مورد نظر یافت نشد یا شما دسترسی ندارید.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در انجام عملیات. لطفاً مجدد تلاش کنید.'
            ], 500);
        }
    }



    public function markAsReadWeb($id)
    {
        $user = Auth::user();

        try {
            $message = Message::query()->where('id', $id)
                ->where('receiver_id', $user->id)
                ->where('receiver_type', $user->getMorphClass())
                ->firstOrFail();

            $message->markAsRead();

            // Also mark thread as read if it's a thread starter
            if ($message->parent_id === null) {
                $this->messageService->markThreadAsRead($message, $user);
            }

            return redirect()->back()
                ->with('success', 'پیام با موفقیت خوانده شد.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'خطا در انجام عملیات.');
        }
    }




}
