@extends('panel.layout.layout')
@section('title')
    پیام‌های محموله {{ $shipment->tracking_code }}
@endsection
@section('breadcrumb')
    @include('panel.sections.breadcrumb', ['breadcrumbs' => '-'])
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            @include('panel.sections.message-info')
            <div class="card mb-4" id="new-message">
                <div class="card-header bg-primary-subtle border-bottom">
                    <h4 class="card-title mb-0 text-primary">
                        <iconify-icon icon="solar:pen-new-square-broken" class="align-middle me-2"></iconify-icon>
                        ارسال پیام جدید
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('representative.messages.store',$shipment->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="shipment_id" value="{{ $shipment->id }}">

                        <div class="row">

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
                                @include('panel.sections.message',['message' => $message])
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


