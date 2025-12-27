@extends('panel.layout.layout')
@section('title')
    مشاهده پیام
@endsection
@section('breadcrumb')
    @php
        $breadcrumbs = [
            ['title' => 'پیام ها', 'url' => route('user.messages')],
            ['title' => 'مشاهده پیام', 'url' => '#'],
        ];
    @endphp
    @include('panel.sections.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title mb-0">
                            <iconify-icon icon="solar:letter-broken" class="align-middle me-2"></iconify-icon>
                            مشاهده پیام
                            @if($message->isReply())
                                <span class="badge bg-secondary-subtle text-secondary fs-12">پاسخ</span>
                            @endif
                        </h4>
                        <p class="text-muted mb-0 fs-13">
                            @if($message->parent_id)
                                این پیام پاسخ به "{{ $message->original_subject }}" است
                            @else
                                @if($message->hasReplies())
                                    <span class="badge bg-info-subtle text-info">
                                        {{ $message->replyCount() }} پاسخ
                                    </span>
                                @endif
                            @endif
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('user.messages') }}" class="btn btn-soft-secondary">
                            بازگشت به لیست
                        </a>
                    </div>
                </div>

                <!-- Message Details -->
                <div class="card-body">
                    @if($message->parent_id && $message->parent)
                        <!-- Parent Message Reference -->
                        <div class="alert alert-light border mb-4">
                            <div class="d-flex align-items-center">
                                <iconify-icon icon="solar:undo-left-broken" class="text-info fs-18 me-2"></iconify-icon>
                                <div class="flex-grow-1">
                                    <p class="mb-0">
                                        <strong>پاسخ به:</strong>
                                        <a href="{{ route('user.messages.show', $message->parent_id) }}" class="text-info">
                                            {{ $message->original_subject }}
                                        </a>
                                    </p>
                                    <small class="text-muted">
                                        ارسال شده توسط {{ $message->parent->sender->name ?? $message->parent->sender->email }}
                                        در {{ jdate($message->parent->created_at)->format('Y/m/d H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Message Header -->
                    <div class="border rounded p-3 bg-light-subtle mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        @if($message->sender_id == auth()->id())
                                            <div class="avatar-sm bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="solar:upload-minimalistic-broken" class="fs-20"></iconify-icon>
                                            </div>
                                        @else
                                            <div class="avatar-sm bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center">
                                                <iconify-icon icon="solar:download-minimalistic-broken" class="fs-20"></iconify-icon>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">
                                            @if($message->sender_id == auth()->id())
                                                ارسال شده به:
                                            @else
                                                دریافت شده از:
                                            @endif
                                        </h6>
                                        <p class="mb-0">
                                            @if($message->sender_id == auth()->id())
                                                <span class="fw-semibold">{{ $message->receiver->name ?? $message->receiver->email }}</span>
                                                <span class="badge bg-success-subtle text-success ms-2">
                                                    {{ class_basename($message->receiver_type) }}
                                                </span>
                                            @else
                                                <span class="fw-semibold">{{ $message->sender->name ?? $message->sender->email }}</span>
                                                <span class="badge bg-info-subtle text-info ms-2">
                                                    {{ class_basename($message->sender_type) }}
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end">
                                    <h6 class="mb-1">تاریخ و زمان:</h6>
                                    <p class="mb-0">
                                        <iconify-icon icon="solar:calendar-broken" class="align-middle me-1"></iconify-icon>
                                        {{ jdate($message->created_at)->format('Y/m/d') }}
                                        <iconify-icon icon="solar:clock-circle-broken" class="align-middle me-1 ms-2"></iconify-icon>
                                        {{ jdate($message->created_at)->format('H:i') }}
                                    </p>
                                    @if($message->read && $message->receiver_id == auth()->id())
                                        <small class="text-muted">
                                            خوانده شده در: {{ jdate($message->read_at)->format('Y/m/d H:i') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Subject -->
                    <div class="mb-4">
                        <h5 class="fw-semibold mb-2">
                            @if(!$message->read && $message->receiver_id == auth()->id())
                                <span class="badge bg-danger rounded-circle me-2" style="width: 10px; height: 10px;"></span>
                            @endif
                            موضوع: {{ $message->subject }}
                        </h5>
                        <div class="d-flex gap-2">
                            @if($message->sender_id == auth()->id())
                                <span class="badge bg-success-subtle text-success">ارسال شده</span>
                            @else
                                @if($message->read)
                                    <span class="badge bg-info-subtle text-info">خوانده شده</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning">خوانده نشده</span>
                                @endif
                            @endif

                            @if($message->isReply())
                                <span class="badge bg-secondary-subtle text-secondary">پاسخ</span>
                            @else
                                <span class="badge bg-primary-subtle text-primary">پیام اصلی</span>
                            @endif
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="mb-4">
                        <div class="border rounded p-4 bg-white">
                            <div class="message-content">
                                {!! nl2br(e($message->message)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Reply Button -->
                    @if($message->sender_id != auth()->id())
                        <div class="mb-4">
                            <form action="{{ route('user.messages.reply.store', $message->id) }}" method="POST">
                                @csrf
                                <div class="card border">
                                    <div class="card-header bg-light-subtle">
                                        <h6 class="mb-0">
                                            <iconify-icon icon="solar:undo-left-broken" class="align-middle me-2"></iconify-icon>
                                            ارسال پاسخ
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="original_subject" value="{{ $message->subject }}">

                                        <div class="mb-3">
                                            <label class="form-label">موضوع پاسخ</label>
                                            <input type="text" name="subject" class="form-control"
                                                   value="RE: {{ $message->subject }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">متن پاسخ</label>
                                            <textarea name="message" class="form-control" rows="4"
                                                      placeholder="متن پاسخ خود را وارد کنید..." required></textarea>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <iconify-icon icon="solar:send-twice-square-linear" class="align-middle me-1"></iconify-icon>
                                                ارسال پاسخ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Message Actions -->
                    <div class="d-flex flex-wrap gap-2 border-top pt-3">
                        <!-- Reply Action -->
                        @if($message->sender_id != auth()->id())
                            <a href="#replyForm" class="btn btn-primary">
                                <iconify-icon icon="solar:undo-left-broken" class="align-middle me-1"></iconify-icon>
                                پاسخ
                            </a>
                        @endif

                        <!-- Mark as Read/Unread -->
                        @if($message->receiver_id == auth()->id())
                            @if($message->read)
                                <form action="{{ route('user.messages.mark-unread', $message->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning">
                                        <iconify-icon icon="solar:letter-unread-broken" class="align-middle me-1"></iconify-icon>
                                        علامت به عنوان خوانده نشده
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('user.messages.mark-read', $message->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">
                                        <iconify-icon icon="solar:letter-read-broken" class="align-middle me-1"></iconify-icon>
                                        علامت به عنوان خوانده شده
                                    </button>
                                </form>
                            @endif
                        @endif

                        <!-- Delete Button -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle me-1"></iconify-icon>
                            حذف پیام
                        </button>

                        <!-- Back Button -->
                        <a href="{{ route('user.messages') }}" class="btn btn-secondary ms-auto">
                            <iconify-icon icon="solar:arrow-left-broken" class="align-middle me-1"></iconify-icon>
                            بازگشت
                        </a>
                    </div>
                </div>
            </div>

            <!-- Replies Section -->
            @if($message->hasReplies())
                <div class="card mt-4">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <iconify-icon icon="solar:conversation-broken" class="align-middle me-2"></iconify-icon>
                            پاسخ‌ها ({{ $message->replyCount() }})
                        </h5>
                        <span class="badge bg-info-subtle text-info">
                            {{ $message->replies()->where('read', false)->count() }} پاسخ خوانده نشده
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @foreach($message->replies as $reply)
                                <div class="timeline-item {{ $reply->id == $message->id ? 'active' : '' }}">
                                    <div class="timeline-marker">
                                        @if($reply->sender_id == auth()->id())
                                            <div class="marker bg-success">
                                                <iconify-icon icon="solar:upload-minimalistic-broken"></iconify-icon>
                                            </div>
                                        @else
                                            <div class="marker bg-info">
                                                <iconify-icon icon="solar:download-minimalistic-broken"></iconify-icon>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        <div class="card {{ $reply->id == $message->id ? 'border-primary' : '' }}">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>
                                                        @if($reply->sender_id == auth()->id())
                                                            <span class="badge bg-success-subtle text-success">
                                                                شما پاسخ دادید
                                                            </span>
                                                        @else
                                                            <span class="badge bg-info-subtle text-info">
                                                                {{ class_basename($reply->sender_type) }} پاسخ داد
                                                            </span>
                                                        @endif
                                                        @if(!$reply->read && $reply->receiver_id == auth()->id())
                                                            <span class="badge bg-warning-subtle text-warning">خوانده نشده</span>
                                                        @endif
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ jdate($reply->created_at)->format('Y/m/d H:i') }}
                                                    </small>
                                                </div>

                                                <h6 class="mb-2">
                                                    @if($reply->id == $message->id)
                                                        <strong>{{ $reply->subject }}</strong>
                                                    @else
                                                        <a href="{{ route('user.messages.show', $reply->id) }}" class="text-dark">
                                                            {{ $reply->subject }}
                                                        </a>
                                                    @endif
                                                </h6>

                                                <div class="message-content mb-2">
                                                    {!! nl2br(e(Str::limit($reply->message, 200))) !!}
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <div>
                                                        @if($reply->sender_id != auth()->id())
                                                            <a href="{{ route('user.messages.show', $reply->id) }}" class="btn btn-sm btn-soft-primary">
                                                                مشاهده کامل و پاسخ
                                                            </a>
                                                        @else
                                                            <a href="{{ route('user.messages.show', $reply->id) }}" class="btn btn-sm btn-soft-info">
                                                                مشاهده کامل
                                                            </a>
                                                        @endif
                                                    </div>

                                                    <!-- Reply Actions -->
                                                    <div class="d-flex gap-1">
                                                        @if($reply->receiver_id == auth()->id())
                                                            @if($reply->read)
                                                                <form action="{{ route('user.messages.mark-unread', $reply->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-sm btn-soft-warning" title="علامت به عنوان خوانده نشده">
                                                                        <iconify-icon icon="solar:letter-unread-broken" class="fs-14"></iconify-icon>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('user.messages.mark-read', $reply->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-sm btn-soft-success" title="علامت به عنوان خوانده شده">
                                                                        <iconify-icon icon="solar:letter-read-broken" class="fs-14"></iconify-icon>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @endif

                                                        <!-- Delete Reply Button -->
                                                        <button type="button" class="btn btn-sm btn-soft-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deleteReplyModal{{ $reply->id }}"
                                                                title="حذف پاسخ">
                                                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="fs-14"></iconify-icon>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Reply Modal -->
                                <div class="modal fade" id="deleteReplyModal{{ $reply->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('user.messages.destroy', $reply->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body text-center">
                                                    <iconify-icon icon="solar:warning-circle-broken" class="text-warning fs-48"></iconify-icon>
                                                    <h5 class="mt-3">آیا از حذف این پاسخ اطمینان دارید؟</h5>
                                                    <p class="text-muted">این عمل قابل بازگشت نیست.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                                                        انصراف
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        حذف پاسخ
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Load More Replies -->
                        @if($message->replyCount() > 5)
                            <div class="text-center mt-4">
                                <button class="btn btn-outline-primary" id="loadMoreReplies">
                                    <iconify-icon icon="solar:refresh-linear" class="align-middle me-1"></iconify-icon>
                                    مشاهده پاسخ‌های بیشتر
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Full Thread View (if not already showing all) -->
            @if($message->parent_id && $thread->count() > 1)
                <div class="card mt-4">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                            <iconify-icon icon="solar:history-broken" class="align-middle me-2"></iconify-icon>
                            تاریخچه کامل مکالمه
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @foreach($thread as $msg)
                                <div class="timeline-item {{ $msg->id == $message->id ? 'active' : '' }}">
                                    <div class="timeline-marker">
                                        @if($msg->sender_id == auth()->id())
                                            <div class="marker bg-success">
                                                <iconify-icon icon="solar:upload-minimalistic-broken"></iconify-icon>
                                            </div>
                                        @else
                                            <div class="marker bg-info">
                                                <iconify-icon icon="solar:download-minimalistic-broken"></iconify-icon>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="timeline-content">
                                        <div class="card {{ $msg->id == $message->id ? 'border-primary' : '' }}">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>
                                                        @if($msg->isReply())
                                                            <span class="badge bg-secondary-subtle text-secondary fs-12">پاسخ</span>
                                                        @endif
                                                        @if($msg->sender_id == auth()->id())
                                                            <span class="badge bg-success-subtle text-success">
                                                                شما
                                                            </span>
                                                        @else
                                                            <span class="badge bg-info-subtle text-info">
                                                                {{ class_basename($msg->sender_type) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ jdate($msg->created_at)->format('Y/m/d H:i') }}
                                                    </small>
                                                </div>

                                                <h6 class="mb-2">
                                                    @if($msg->id == $message->id)
                                                        <strong>{{ $msg->subject }}</strong>
                                                    @else
                                                        <a href="{{ route('user.messages.show', $msg->id) }}" class="text-dark">
                                                            {{ $msg->subject }}
                                                        </a>
                                                    @endif
                                                </h6>

                                                <div class="message-content mb-2">
                                                    {!! nl2br(e(Str::limit($msg->message, 150))) !!}
                                                </div>

                                                <div class="mt-2">
                                                    <a href="{{ route('user.messages.show', $msg->id) }}" class="btn btn-sm btn-soft-primary">
                                                        مشاهده کامل
                                                    </a>
                                                    @if($msg->sender_id != auth()->id())
                                                        <a href="#replyForm" class="btn btn-sm btn-soft-success">
                                                            پاسخ
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('user.messages.destroy', $message->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center">
                        <iconify-icon icon="solar:warning-circle-broken" class="text-warning fs-48"></iconify-icon>
                        <h5 class="mt-3">آیا از حذف این پیام اطمینان دارید؟</h5>
                        <p class="text-muted">
                            @if($message->hasReplies())
                                <strong>توجه:</strong> تمام پاسخ‌های مرتبط با این پیام نیز حذف خواهند شد.
                            @endif
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                            انصراف
                        </button>
                        <button type="submit" class="btn btn-danger">
                            حذف پیام
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: -15px;
            top: 0;
            z-index: 2;
        }

        .timeline-marker .marker {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .timeline-content {
            position: relative;
            padding-left: 20px;
        }

        .timeline-content::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e9ecef;
        }

        .timeline-item.active .timeline-content::before {
            background-color: #0d6efd;
        }

        .timeline-item:last-child .timeline-content::before {
            height: 20px;
        }

        .message-content {
            line-height: 1.8;
            font-size: 15px;
        }

        .message-content p {
            margin-bottom: 1rem;
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
        }

        .fs-12 {
            font-size: 12px;
        }

        .fs-13 {
            font-size: 13px;
        }

        .fs-14 {
            font-size: 14px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Smooth scroll to reply form
            $('a[href="#replyForm"]').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $('#replyForm').offset().top - 100
                }, 500);
            });

            // Load more replies
            $('#loadMoreReplies').on('click', function() {
                const button = $(this);
                const messageId = {{ $message->id }};
                const currentCount = $('.timeline-item').length - 1; // Exclude current message

                button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>در حال بارگذاری...');

                $.ajax({
                    url: '{{ route("user.messages.load-replies", $message->id) }}',
                    method: 'GET',
                    data: {
                        offset: currentCount
                    },
                    success: function(response) {
                        if (response.success && response.data.length > 0) {
                            // Append new replies
                            response.data.forEach(function(reply) {
                                // Create timeline item for each reply
                                // You can implement the template rendering here
                            });

                            if (response.data.length < 10) {
                                button.hide();
                            }
                        } else {
                            button.hide();
                        }
                    },
                    error: function() {
                        button.prop('disabled', false).html('مشکلی پیش آمد. مجدد تلاش کنید.');
                    }
                });
            });
        });
    </script>
@endpush
