@extends('panel.layout.layout')
@section('title')
    پیام ها
@endsection
@section('breadcrumb')
    پیام ها
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title">
                            پیام ها
                        </h4>
                        <p class="card-title-desc text-muted mb-0">
                            <span class="badge bg-info-subtle text-info">
{{--                                {{ $unread_count }}--}}
                                پیام خوانده نشده
                            </span>
                        </p>
                    </div>
                    <div>
{{--                        <a class="card-title btn btn-info" href="{{ route('user.messages.create') }}">--}}
{{--                            <iconify-icon icon="solar:letter-broken" class="align-middle fs-18"></iconify-icon>--}}
{{--                            ارسال پیام جدید--}}
{{--                        </a>--}}
                    </div>
                </div>
                <div class="card-body p-0">
                    <!-- Messages Navigation -->
                    <div class="border-bottom">
                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
{{--                                <a class="nav-link {{ request()->is('user/messages') && !request()->has('type') ? 'active' : '' }}"--}}
{{--                                   href="{{ route('user.messages.index') }}">--}}
{{--                                    همه پیام ها--}}
{{--                                    <span class="badge bg-secondary-subtle text-secondary ms-1">{{ $total_count }}</span>--}}
{{--                                </a>--}}
                            </li>
                            <li class="nav-item">
{{--                                <a class="nav-link {{ request()->get('type') == 'inbox' ? 'active' : '' }}"--}}
{{--                                   href="{{ route('user.messages.index', ['type' => 'inbox']) }}">--}}
{{--                                    دریافتی--}}
{{--                                    <span class="badge bg-info-subtle text-info ms-1">{{ $received_count }}</span>--}}
{{--                                </a>--}}
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->get('type') == 'sent' ? 'active' : '' }}"
                                   href="{{ route('user.messages.index', ['type' => 'sent']) }}">
                                    ارسال شده
                                    <span class="badge bg-success-subtle text-success ms-1">{{ $sent_count }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->get('type') == 'unread' ? 'active' : '' }}"
                                   href="{{ route('user.messages.index', ['type' => 'unread']) }}">
                                    خوانده نشده
                                    <span class="badge bg-warning-subtle text-warning ms-1">{{ $unread_count }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap text-center table-hover table-centered mb-0">
                            <thead class="bg-light-subtle">
                            <tr>
                                <th width="50px"></th>
                                <th>فرستنده/گیرنده</th>
                                <th>موضوع</th>
                                <th>متن پیام</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>
                                <th>تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($messages as $message)
                                <tr class="{{ !$message->read && $message->receiver_id == auth()->id() ? 'table-active' : '' }}">
                                    <td>
                                        @if($message->sender_id == auth()->id())
                                            <iconify-icon icon="solar:upload-minimalistic-broken"
                                                          class="text-success fs-20"
                                                          title="پیام ارسال شده"></iconify-icon>
                                        @else
                                            <iconify-icon icon="solar:download-minimalistic-broken"
                                                          class="text-info fs-20"
                                                          title="پیام دریافتی"></iconify-icon>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column text-start">
                                            @if($message->sender_id == auth()->id())
                                                <span class="fw-semibold">به:
                                                    <span class="text-primary">
                                                        {{ $message->receiver->name ?? $message->receiver->email }}
                                                    </span>
                                                </span>
                                                <small class="text-muted">
                                                    {{ class_basename($message->receiver_type) }}
                                                </small>
                                            @else
                                                <span class="fw-semibold">از:
                                                    <span class="text-info">
                                                        {{ $message->sender->name ?? $message->sender->email }}
                                                    </span>
                                                </span>
                                                <small class="text-muted">
                                                    {{ class_basename($message->sender_type) }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <div class="d-flex align-items-center">
                                            @if(!$message->read && $message->receiver_id == auth()->id())
                                                <span class="badge bg-danger rounded-circle me-2" style="width: 8px; height: 8px;"></span>
                                            @endif
                                            <span class="{{ !$message->read && $message->receiver_id == auth()->id() ? 'fw-bold' : '' }}">
                                                {{ Str::limit($message->subject, 30) }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        <span class="text-muted">
                                            {{ Str::limit(strip_tags($message->message), 50) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($message->sender_id == auth()->id())
                                            <span class="badge bg-success-subtle text-success py-1 px-2 fs-13">
                                                ارسال شده
                                            </span>
                                        @else

                                            @if($message->read)
                                                <span class="badge bg-info-subtle text-info py-1 px-2 fs-13">
                                                    خوانده شده
                                                </span>
                                                <br>
                                                <small class="text-muted">
                                                    {{ jdate($message->read_at)->format('H:i') }}
                                                </small>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning py-1 px-2 fs-13">
                                                    خوانده نشده
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td dir="ltr">
                                        <div class="d-flex flex-column">
                                            <span>{{ jdate($message->created_at)->format('Y/m/d') }}</span>
                                            <small class="text-muted">{{ jdate($message->created_at)->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class="btn btn-soft-info btn-sm"
                                               href="{{ route('user.messages.show', $message->id) }}"
                                               title="مشاهده پیام">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:eye-broken"></iconify-icon>
                                            </a>

{{--                                            @if($message->sender_id != auth()->id())--}}
{{--                                                <a class="btn btn-soft-primary btn-sm"--}}
{{--                                                   href="{{ route('user.messages.reply', $message->id) }}"--}}
{{--                                                   title="پاسخ">--}}
{{--                                                    <iconify-icon class="align-middle fs-18"--}}
{{--                                                                  icon="solar:undo-left-broken"></iconify-icon>--}}
{{--                                                </a>--}}
{{--                                            @endif--}}

{{--                                            @if($message->receiver_id == auth()->id())--}}
{{--                                                @if($message->read)--}}
{{--                                                    <form action="{{ route('user.messages.mark-unread', $message->id) }}"--}}
{{--                                                          method="POST" style="display: inline;">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('PUT')--}}
{{--                                                        <button type="submit" class="btn btn-soft-warning btn-sm"--}}
{{--                                                                title="علامت به عنوان خوانده نشده">--}}
{{--                                                            <iconify-icon class="align-middle fs-18"--}}
{{--                                                                          icon="solar:letter-unread-broken"></iconify-icon>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                @else--}}
{{--                                                    <form action="{{ route('user.messages.mark-read', $message->id) }}"--}}
{{--                                                          method="POST" style="display: inline;">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('PUT')--}}
{{--                                                        <button type="submit" class="btn btn-soft-success btn-sm"--}}
{{--                                                                title="علامت به عنوان خوانده شده">--}}
{{--                                                            <iconify-icon class="align-middle fs-18"--}}
{{--                                                                          icon="solar:letter-read-broken"></iconify-icon>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                @endif--}}
{{--                                            @endif--}}

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <iconify-icon icon="solar:inbox-line-duotone" class="fs-48 text-muted"></iconify-icon>
                                        <h5 class="mt-3">پیامی یافت نشد</h5>
                                        <p class="text-muted">هنوز هیچ پیامی دریافت یا ارسال نکرده‌اید.</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($messages->count() > 0)
                    @include('panel.sections.pagination',['paginator' => $messages])
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto refresh unread count every 30 seconds
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    </script>
@endpush
