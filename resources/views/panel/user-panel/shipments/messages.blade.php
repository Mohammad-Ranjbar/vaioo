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
            <div class="card mb-4">
                <div class="card-header bg-light-subtle border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <iconify-icon icon="solar:box-broken" class="align-middle me-2"></iconify-icon>
                        اطلاعات محموله
                    </h4>

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
                        <div class="row border p-2">
                            <div class="col-12">
                                <label class="form-label text-muted">توضیحات</label>
                                <hr>
                                <p class="mb-0">{{ $shipment->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


            <div class="card mb-4" id="new-message">
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

                                    <div>
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

                    </div>
                </div>

                <div class="card-body">
                    @if($shipment->receivedMessages->count() > 0)

                        <div class="row" id="messagesGrid">
                            @foreach($shipment->receivedMessages->sortByDesc('created_at') as $message)
                                <div class="col-md-12 mb-4 message-item"
                                     data-sender="{{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}"
                                     data-read="{{ $message->read ? 'read' : 'unread' }}"
                                     data-replies="{{ $message->replies->count() > 0 ? 'has-replies' : 'no-replies' }}">

                                    <div class="card h-100 {{ !$message->read && $message->receiver_id == auth()->id() ? 'border-warning border-2' : 'border-light' }}">
                                        <div class="card-header bg-light-subtle border-bottom d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                @if($message->sender_id == auth()->id())
                                                    <div class="avatar-sm bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-2">
                                                        <iconify-icon icon="solar:upload-minimalistic-broken" class="fs-18"></iconify-icon>
                                                    </div>
                                                @else
                                                    <div class="avatar-sm bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center me-2">
                                                        <iconify-icon icon="solar:download-minimalistic-broken" class="fs-18"></iconify-icon>
                                                    </div>
                                                @endif

                                                <div>
                                                    <h6 class="mb-0">
                                                        @if($message->sender_id == auth()->id())
                                                            شما
                                                        @else
                                                            {{ class_basename($message->sender_type) }}
                                                        @endif
                                                    </h6>
                                                    <small class="text-muted">
                                                        {{ jdate($message->created_at)->format('Y/m/d H:i') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title mb-3">
                                                <span  class="text-dark text-decoration-none">
                                                    {{ $message->subject }}
                                                </span>
                                                @if(!$message->read && $message->receiver_id == auth()->id())
                                                    <span class="badge bg-danger rounded-circle ms-1" style="width: 8px; height: 8px;"></span>
                                                @endif
                                            </h5>
                                            <div class="mb-3">
                                                <div class="message-content">
                                                   {{$message->message}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @else
                        <div class="text-center py-5">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="avatar-title bg-light-subtle text-primary rounded-circle">
                                    <iconify-icon icon="solar:chat-round-line-broken" class="fs-24"></iconify-icon>
                                </div>
                            </div>
                            <h5 class="mb-2">هنوز پیامی وجود ندارد</h5>
                            <hr>
                            <br>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('user.shipments.show', $shipment->id) }}" class="btn btn-outline-secondary">
                                    <iconify-icon icon="solar:arrow-left-broken" class="align-middle me-1"></iconify-icon>
                                    مشاهده محموله
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                @if($shipment->receivedMessages->count() > 0)
                    <div class="card-footer border-top">
                        <div class="row">
                            <div class="col-md-4 col-6 text-center">
                                <div class="p-3">
                                    <h3 class="text-primary mb-0">{{ $shipment->receivedMessages->count() }}</h3>
                                    <p class="text-muted mb-0">کل پیام‌ها</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 text-center">
                                <div class="p-3">
                                    <h3 class="text-success mb-0">
                                        {{ $shipment->receivedMessages->where('sender_id', auth()->id())->count() }}
                                    </h3>
                                    <p class="text-muted mb-0">ارسال شده توسط شما</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-6 text-center">
                                <div class="p-3">
                                    <h3 class="text-info mb-0">
                                        {{ $shipment->receivedMessages->where('sender_id', '!=', auth()->id())->count() }}
                                    </h3>
                                    <p class="text-muted mb-0">دریافتی از دیگران</p>
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
