@extends('panel.layout.layout')
@section('title')
    پیام‌های محموله {{ $shipment->tracking_code }}
@endsection
@section('breadcrumb')
    @php
        $breadcrumbs = [
            ['title' => 'محموله‌ها', 'url' => route('user.shipments.index')],
            ['title' => 'مشاهده محموله', 'url' => route('user.shipments.show', $shipment->id)],
            ['title' => 'پیام‌های محموله', 'url' => '#'],
        ];
    @endphp
    @include('panel.sections.breadcrumb', ['breadcrumbs' => $breadcrumbs])
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <!-- Shipment Info Card -->
            <div class="card mb-4">
                <div class="card-header bg-light-subtle border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <iconify-icon icon="solar:box-broken" class="align-middle me-2"></iconify-icon>
                        اطلاعات محموله
                    </h4>
                    <div class="dropdown">
                        <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <iconify-icon icon="solar:menu-dots-broken"></iconify-icon>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.shipments.show', $shipment->id) }}">
                                    <iconify-icon icon="solar:eye-broken" class="align-middle me-2"></iconify-icon>
                                    مشاهده جزئیات محموله
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('user.messages.index') }}">
                                    <iconify-icon icon="solar:letter-broken" class="align-middle me-2"></iconify-icon>
                                    مشاهده همه پیام‌ها
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted">کد رهگیری</label>
                            <div class="fw-semibold d-flex align-items-center">
                                <iconify-icon icon="solar:qr-code-broken" class="text-primary me-2"></iconify-icon>
                                {{ $shipment->tracking_code }}
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted">وضعیت</label>
                            <div>
                                <span class="badge bg-{{ $shipment->status_color }}-subtle text-{{ $shipment->status_color }}">
                                    <iconify-icon icon="solar:check-circle-broken" class="align-middle me-1"></iconify-icon>
                                    {{ $shipment->status_label }}
                                </span>
                            </div>
                        </div>
                        @if($shipment->trip)
                            <div class="col-md-3 mb-3">
                                <label class="form-label text-muted">سفر مرتبط</label>
                                <div class="fw-semibold d-flex align-items-center">
                                    <iconify-icon icon="solar:route-broken" class="text-info me-2"></iconify-icon>
                                    {{ $shipment->trip->title ?? 'بدون عنوان' }}
                                </div>
                            </div>
                        @endif
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted">تاریخ ایجاد</label>
                            <div class="fw-semibold d-flex align-items-center">
                                <iconify-icon icon="solar:calendar-broken" class="text-success me-2"></iconify-icon>
                                {{ jdate($shipment->created_at)->format('Y/m/d H:i') }}
                            </div>
                        </div>
                    </div>
                    @if($shipment->description)
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label text-muted">توضیحات</label>
                                <p class="mb-0">{{ $shipment->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Create New Message Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary-subtle border-bottom">
                    <h4 class="card-title mb-0 text-primary">
                        <iconify-icon icon="solar:pen-new-square-broken" class="align-middle me-2"></iconify-icon>
                        ارسال پیام جدید
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.messages.store',$shipment->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="shipment_id" value="{{ $shipment->id }}">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">موضوع پیام <span class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control"
                                       value="در مورد محموله {{ $shipment->tracking_code }}"
                                       required>
                                <small class="text-muted">موضوع پیام به صورت خودکار پر شده است</small>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">متن پیام <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control" rows="4"
                                          placeholder="متن پیام خود را در مورد این محموله وارد کنید..."
                                          required></textarea>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="copy_to_email" id="copy_to_email" value="1">
                                        <label class="form-check-label" for="copy_to_email">
                                            ارسال کپی به ایمیل
                                        </label>
                                    </div>

                                    <div>
                                        <button type="button" class="btn btn-secondary me-2" onclick="resetForm()">
                                            <iconify-icon icon="solar:eraser-broken" class="align-middle me-1"></iconify-icon>
                                            پاک کردن
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <iconify-icon icon="solar:send-twice-square-linear" class="align-middle me-1"></iconify-icon>
                                            ارسال پیام
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Messages Section -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title mb-0">
                            <iconify-icon icon="solar:chat-line-broken" class="align-middle me-2"></iconify-icon>
                            تاریخچه پیام‌ها
                            @if($shipment->receivedMessages->count() > 0)
                                <span class="badge bg-primary rounded-pill ms-2">
                                    {{ $shipment->receivedMessages->count() }}
                                </span>
                            @endif
                        </h4>
                        <p class="text-muted mb-0 fs-13">
                            تمامی پیام‌های رد و بدل شده در مورد این محموله
                        </p>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-soft-info" id="refreshMessages">
                            <iconify-icon icon="solar:refresh-broken" class="align-middle"></iconify-icon>
                        </button>
                        <a href="{{ route('user.shipments.show', $shipment->id) }}" class="btn btn-soft-secondary">
                            <iconify-icon icon="solar:arrow-left-broken" class="align-middle me-1"></iconify-icon>
                            بازگشت
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if($shipment->receivedMessages->count() > 0)
                        <!-- Messages Filter -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <iconify-icon icon="solar:magnifer-broken"></iconify-icon>
                                    </span>
                                    <input type="text" class="form-control" id="messageSearch" placeholder="جستجو در پیام‌ها...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex gap-2 justify-content-end">
                                    <select class="form-select w-auto" id="messageFilter">
                                        <option value="all">همه پیام‌ها</option>
                                        <option value="sent">ارسال شده توسط من</option>
                                        <option value="received">دریافتی از دیگران</option>
                                        <option value="unread">خوانده نشده</option>
                                        <option value="with_replies">دارای پاسخ</option>
                                    </select>

                                    <select class="form-select w-auto" id="messageSort">
                                        <option value="newest">جدیدترین</option>
                                        <option value="oldest">قدیمی‌ترین</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Messages Timeline -->
                        <div class="timeline" id="messagesTimeline">
                            @foreach($shipment->receivedMessages->sortByDesc('created_at') as $message)
                                <div class="timeline-item message-item"
                                     data-sender="{{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}"
                                     data-read="{{ $message->read ? 'read' : 'unread' }}"
                                     data-replies="{{ $message->replies->count() > 0 ? 'has-replies' : 'no-replies' }}">
                                    <div class="timeline-marker">
                                        @if($message->sender_id == auth()->id())
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
                                        <div class="card {{ !$message->read && $message->receiver_id == auth()->id() ? 'border-warning' : '' }}">
                                            <div class="card-body">
                                                <!-- Message Header -->
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2 mb-1">
                                                            <!-- Sender/Receiver Info -->
                                                            @if($message->sender_id == auth()->id())
                                                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                                                    <iconify-icon icon="solar:user-check-broken" class="me-1"></iconify-icon>
                                                                    شما
                                                                </span>
                                                                <iconify-icon icon="solar:arrow-right-broken" class="text-muted"></iconify-icon>
                                                                <span class="fw-semibold">{{ $message->receiver->name ?? $message->receiver->email }}</span>
                                                            @else
                                                                <span class="badge bg-info-subtle text-info border border-info-subtle">
                                                                    <iconify-icon icon="solar:user-broken" class="me-1"></iconify-icon>
                                                                    {{ class_basename($message->sender_type) }}
                                                                </span>
                                                                <iconify-icon icon="solar:arrow-left-broken" class="text-muted"></iconify-icon>
                                                                <span class="fw-semibold">{{ $message->sender->name ?? $message->sender->email }}</span>
                                                            @endif

                                                            <!-- Urgent Badge -->
                                                            @if($message->priority == 'urgent')
                                                                <span class="badge bg-danger">
                                                                    <iconify-icon icon="solar:danger-broken" class="me-1"></iconify-icon>
                                                                    فوری
                                                                </span>
                                                            @endif
                                                        </div>

                                                        <!-- Subject -->
                                                        <h5 class="mb-0">
                                                            <a href="{{ route('user.messages.show', $message->id) }}" class="text-dark text-decoration-none">
                                                                {{ $message->subject }}
                                                            </a>
                                                        </h5>
                                                    </div>

                                                    <!-- Time & Status -->
                                                    <div class="text-end flex-shrink-0 ms-3">
                                                        <small class="text-muted d-block">
                                                            <iconify-icon icon="solar:calendar-broken" class="align-middle me-1"></iconify-icon>
                                                            {{ jdate($message->created_at)->format('Y/m/d') }}
                                                        </small>
                                                        <small class="text-muted">
                                                            <iconify-icon icon="solar:clock-circle-broken" class="align-middle me-1"></iconify-icon>
                                                            {{ jdate($message->created_at)->format('H:i') }}
                                                        </small>

                                                        <!-- Read Status -->
                                                        @if($message->receiver_id == auth()->id())
                                                            @if($message->read)
                                                                <small class="d-block text-success mt-1">
                                                                    <iconify-icon icon="solar:check-read-broken" class="align-middle me-1"></iconify-icon>
                                                                    خوانده شده
                                                                </small>
                                                            @else
                                                                <small class="d-block text-warning mt-1">
                                                                    <iconify-icon icon="solar:eye-closed-broken" class="align-middle me-1"></iconify-icon>
                                                                    خوانده نشده
                                                                </small>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Message Content Preview -->
                                                <div class="border rounded p-3 bg-light-subtle mb-3">
                                                    <div class="message-content-preview">
                                                        {!! Str::limit(nl2br(e($message->message)), 200) !!}
                                                    </div>
                                                    @if(strlen($message->message) > 200)
                                                        <div class="text-end mt-2">
                                                            <a href="{{ route('user.messages.show', $message->id) }}" class="text-primary fs-13">
                                                                مشاهده کامل متن
                                                                <iconify-icon icon="solar:arrow-left-broken" class="align-middle"></iconify-icon>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Message Actions -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <!-- Left Actions -->
                                                    <div class="d-flex gap-2">
                                                        <!-- View Full Message -->
                                                        <a href="{{ route('user.messages.show', $message->id) }}"
                                                           class="btn btn-sm btn-outline-primary">
                                                            <iconify-icon icon="solar:eye-broken" class="align-middle me-1"></iconify-icon>
                                                            مشاهده کامل
                                                        </a>

                                                        <!-- Reply Button -->
                                                        @if($message->sender_id != auth()->id())
                                                            <a href="{{ route('user.messages.show', $message->id) }}#replyForm"
                                                               class="btn btn-sm btn-outline-success">
                                                                <iconify-icon icon="solar:undo-left-broken" class="align-middle me-1"></iconify-icon>
                                                                پاسخ
                                                            </a>
                                                        @endif
                                                    </div>

                                                    <!-- Right Badges -->
                                                    <div class="d-flex gap-2">
                                                        <!-- Replies Badge -->
                                                        @if($message->replies->count() > 0)
                                                            <a href="{{ route('user.messages.show', $message->id) }}"
                                                               class="badge bg-info-subtle text-info text-decoration-none">
                                                                <iconify-icon icon="solar:chat-round-line-broken" class="align-middle me-1"></iconify-icon>
                                                                {{ $message->replyCount() }} پاسخ
                                                            </a>
                                                        @endif

                                                        <!-- Priority Badge -->
                                                        @if($message->priority != 'normal')
                                                            <span class="badge bg-{{ $message->priority == 'urgent' ? 'danger' : 'warning' }}-subtle
                                                                      text-{{ $message->priority == 'urgent' ? 'danger' : 'warning' }}">
                                                                {{ $message->priority_label }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- No Messages Match Filter -->
                        <div id="noMessagesFound" class="text-center py-5 d-none">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="avatar-title bg-light-subtle text-secondary rounded-circle">
                                    <iconify-icon icon="solar:search-broken" class="fs-24"></iconify-icon>
                                </div>
                            </div>
                            <h5 class="mb-2">پیامی یافت نشد</h5>
                            <p class="text-muted">هیچ پیامی با فیلترهای انتخابی مطابقت ندارد.</p>
                            <button type="button" class="btn btn-secondary" onclick="resetFilters()">
                                <iconify-icon icon="solar:refresh-broken" class="align-middle me-1"></iconify-icon>
                                بازنشانی فیلترها
                            </button>
                        </div>

                    @else
                        <!-- No Messages Found -->
                        <div class="text-center py-5">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="avatar-title bg-light-subtle text-primary rounded-circle">
                                    <iconify-icon icon="solar:chat-round-line-broken" class="fs-24"></iconify-icon>
                                </div>
                            </div>
                            <h5 class="mb-2">هنوز پیامی وجود ندارد</h5>
                            <p class="text-muted mb-4">شما اولین نفری باشید که در مورد این محموله پیام ارسال می‌کند.</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="#createMessage" class="btn btn-primary">
                                    <iconify-icon icon="solar:pen-new-square-broken" class="align-middle me-1"></iconify-icon>
                                    ارسال پیام جدید
                                </a>
                                <a href="{{ route('user.shipments.show', $shipment->id) }}" class="btn btn-outline-secondary">
                                    <iconify-icon icon="solar:arrow-left-broken" class="align-middle me-1"></iconify-icon>
                                    بازگشت به محموله
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Message Statistics -->
                @if($shipment->receivedMessages->count() > 0)
                    <div class="card-footer border-top">
                        <div class="row">
                            <div class="col-md-3 col-6 text-center">
                                <div class="p-3">
                                    <h3 class="text-primary mb-0">{{ $shipment->receivedMessages->count() }}</h3>
                                    <p class="text-muted mb-0">کل پیام‌ها</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 text-center">
                                <div class="p-3">
                                    <h3 class="text-success mb-0">
                                        {{ $shipment->receivedMessages->where('sender_id', auth()->id())->count() }}
                                    </h3>
                                    <p class="text-muted mb-0">ارسال شده توسط شما</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 text-center">
                                <div class="p-3">
                                    <h3 class="text-info mb-0">
                                        {{ $shipment->receivedMessages->where('sender_id', '!=', auth()->id())->count() }}
                                    </h3>
                                    <p class="text-muted mb-0">دریافتی از دیگران</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-6 text-center">
                                <div class="p-3">
                                    <h3 class="text-warning mb-0">
                                        {{ $shipment->receivedMessages->where('read', 0)->where('receiver_id', auth()->id())->count() }}
                                    </h3>
                                    <p class="text-muted mb-0">خوانده نشده</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
            transition: all 0.3s ease;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-item.hidden {
            display: none;
        }

        .timeline-marker {
            position: absolute;
            left: -15px;
            top: 20px;
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
            border: 3px solid white;
            box-shadow: 0 0 0 3px #e9ecef;
            transition: all 0.3s ease;
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

        .timeline-item:last-child .timeline-content::before {
            height: 30px;
        }

        .message-content-preview {
            line-height: 1.8;
            font-size: 14px;
            max-height: 100px;
            overflow: hidden;
        }

        .avatar-lg {
            width: 80px;
            height: 80px;
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

        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        /* Unread message styling */
        .card.border-warning {
            border-width: 2px !important;
        }

        /* Hover effect */
        .timeline-item:hover .marker {
            transform: scale(1.1);
            box-shadow: 0 0 0 3px #e9ecef, 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Statistics cards */
        .card-footer .col-md-3 {
            border-right: 1px solid #e9ecef;
        }

        .card-footer .col-md-3:last-child {
            border-right: none;
        }

        @media (max-width: 768px) {
            .card-footer .col-md-3 {
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }
            .card-footer .col-md-3:last-child {
                border-bottom: none;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form reset function
            window.resetForm = function() {
                document.querySelector('form').reset();
                document.querySelector('textarea[name="message"]').value = '';
            };

            // Filter and search functionality
            const messageSearch = document.getElementById('messageSearch');
            const messageFilter = document.getElementById('messageFilter');
            const messageSort = document.getElementById('messageSort');
            const messagesTimeline = document.getElementById('messagesTimeline');
            const noMessagesFound = document.getElementById('noMessagesFound');
            const messageItems = document.querySelectorAll('.message-item');

            function filterMessages() {
                const searchTerm = messageSearch.value.toLowerCase();
                const filterValue = messageFilter.value;
                const sortValue = messageSort.value;

                let visibleCount = 0;

                // Filter and search
                messageItems.forEach(item => {
                    const senderType = item.dataset.sender;
                    const readStatus = item.dataset.read;
                    const hasReplies = item.dataset.replies;
                    const content = item.textContent.toLowerCase();

                    let matchesSearch = searchTerm === '' || content.includes(searchTerm);
                    let matchesFilter = true;

                    switch(filterValue) {
                        case 'sent':
                            matchesFilter = senderType === 'sent';
                            break;
                        case 'received':
                            matchesFilter = senderType === 'received';
                            break;
                        case 'unread':
                            matchesFilter = readStatus === 'unread' && senderType === 'received';
                            break;
                        case 'with_replies':
                            matchesFilter = hasReplies === 'has-replies';
                            break;
                    }

                    if (matchesSearch && matchesFilter) {
                        item.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                    }
                });

                // Sort messages
                if (sortValue === 'oldest') {
                    const timeline = document.querySelector('.timeline');
                    const items = Array.from(timeline.querySelectorAll('.timeline-item:not(.hidden)'));
                    items.sort((a, b) => {
                        return a.querySelector('.text-muted').textContent.localeCompare(b.querySelector('.text-muted').textContent);
                    });
                    items.forEach(item => timeline.appendChild(item));
                } else {
                    const timeline = document.querySelector('.timeline');
                    const items = Array.from(timeline.querySelectorAll('.timeline-item:not(.hidden)'));
                    items.sort((a, b) => {
                        return b.querySelector('.text-muted').textContent.localeCompare(a.querySelector('.text-muted').textContent);
                    });
                    items.forEach(item => timeline.appendChild(item));
                }

                // Show/hide no messages found
                if (visibleCount === 0) {
                    noMessagesFound.classList.remove('d-none');
                } else {
                    noMessagesFound.classList.add('d-none');
                }
            }

            // Event listeners
            if (messageSearch) {
                messageSearch.addEventListener('input', filterMessages);
            }

            if (messageFilter) {
                messageFilter.addEventListener('change', filterMessages);
            }

            if (messageSort) {
                messageSort.addEventListener('change', filterMessages);
            }

            // Reset filters function
            window.resetFilters = function() {
                messageSearch.value = '';
                messageFilter.value = 'all';
                messageSort.value = 'newest';
                filterMessages();
            };

            // Refresh messages button
            const refreshBtn = document.getElementById('refreshMessages');
            if (refreshBtn) {
                refreshBtn.addEventListener('click', function() {
                    refreshBtn.classList.add('spinning');
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                });
            }

            // Auto-scroll to create message form if URL has hash
            if (window.location.hash === '#createMessage') {
                document.querySelector('.card.mb-4').scrollIntoView({
                    behavior: 'smooth'
                });
            }

            // Mark all messages as read on page load
            const unreadMessages = document.querySelectorAll('.card.border-warning');
            if (unreadMessages.length > 0) {
                // You can add AJAX call here to mark messages as read
                // Example:
                /*
                fetch('/api/messages/mark-as-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        shipment_id: {{ $shipment->id }}
                })
            });
            */
            }
        });
    </script>
@endpush