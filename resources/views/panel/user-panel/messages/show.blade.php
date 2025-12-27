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
                        </h4>
                    </div>
                    <div>
                        <a href="{{ route('user.messages') }}" class="btn btn-soft-secondary">
                            بازگشت به لیست
                        </a>
                    </div>
                </div>

                <!-- Message Details -->
                <div class="card-body">
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

                    <!-- Message Actions -->
                    <div class="d-flex flex-wrap gap-2 border-top pt-3">
                        @if($message->sender_id != auth()->id())
{{--                            <a href="{{ route('user.messages.reply', $message->id) }}" class="btn btn-primary">--}}
{{--                                <iconify-icon icon="solar:undo-left-broken" class="align-middle me-1"></iconify-icon>--}}
{{--                                پاسخ به پیام--}}
{{--                            </a>--}}

                        @endif

                        <!-- Mark as Read/Unread -->
                        @if($message->receiver_id == auth()->id())
                            @if($message->read)
{{--                                <form action="{{ route('user.messages.mark-unread', $message->id) }}" method="POST" class="d-inline">--}}
{{--                                    @csrf--}}
{{--                                    @method('PUT')--}}
{{--                                    <button type="submit" class="btn btn-warning">--}}
{{--                                        <iconify-icon icon="solar:letter-unread-broken" class="align-middle me-1"></iconify-icon>--}}
{{--                                        علامت به عنوان خوانده نشده--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                            @else
{{--                                <form action="{{ route('user.messages.mark-read', $message->id) }}" method="POST" class="d-inline">--}}
{{--                                    @csrf--}}
{{--                                    @method('PUT')--}}
{{--                                    <button type="submit" class="btn btn-success">--}}
{{--                                        <iconify-icon icon="solar:letter-read-broken" class="align-middle me-1"></iconify-icon>--}}
{{--                                        علامت به عنوان خوانده شده--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                            @endif
                        @endif

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle me-1"></iconify-icon>
                            حذف پیام
                        </button>

                        <a href="{{ route('user.messages') }}" class="btn btn-secondary ms-auto">
                            <iconify-icon icon="solar:arrow-left-broken" class="align-middle me-1"></iconify-icon>
                            بازگشت
                        </a>
                    </div>
                </div>
            </div>

            <!-- Conversation History -->
            @if($conversation->count() > 1)
                <div class="card mt-4">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                            <iconify-icon icon="solar:conversation-broken" class="align-middle me-2"></iconify-icon>
                            تاریخچه مکاتبات
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            @foreach($conversation as $msg)
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
                                    <div class="timeline-content {{ $msg->id == $message->id ? 'border-primary' : '' }}">
                                        <div class="card {{ $msg->id == $message->id ? 'border' : 'border-0' }}">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <div>
                                                        @if($msg->sender_id == auth()->id())
                                                            <span class="badge bg-success-subtle text-success">
                                                                شما به {{ class_basename($msg->receiver_type) }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-info-subtle text-info">
                                                                {{ class_basename($msg->sender_type) }} به شما
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
                                                <p class="text-muted mb-0">
                                                    {{ Str::limit(strip_tags($msg->message), 100) }}
                                                </p>
                                                @if($msg->id != $message->id)
                                                    <div class="mt-2">
                                                        <a href="{{ route('user.messages.show', $msg->id) }}" class="btn btn-sm btn-soft-primary">
                                                            مشاهده کامل
                                                        </a>
                                                    </div>
                                                @endif
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
    </style>
@endpush
