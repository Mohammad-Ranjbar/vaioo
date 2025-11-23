@extends('panel.layout.layout')
@section('title')
    مشاهده محموله - {{ $shipment->tracking_code }}
@endsection
@section('breadcrumb')
    مشاهده محموله
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title">
                            محموله - {{ $shipment->tracking_code }}
                        </h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">
                            بازگشت به لیست
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light-subtle">
                                    <h5 class="card-title mb-0">اطلاعات پایه</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="40%"><strong>کد رهگیری:</strong></td>
                                            <td><code>{{ $shipment->tracking_code }}</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>وضعیت:</strong></td>
                                            <td>
                                                @switch($shipment->status)
                                                    @case('pending')
                                                        <span class="badge bg-warning-subtle text-warning">در انتظار</span>
                                                        @break
                                                    @case('accepted')
                                                        <span class="badge bg-info-subtle text-info">پذیرفته شده</span>
                                                        @break
                                                    @case('picked_up')
                                                        <span class="badge bg-primary-subtle text-primary">تحویل گرفته شده</span>
                                                        @break
                                                    @case('in_transit')
                                                        <span class="badge bg-secondary-subtle text-secondary">در حال انتقال</span>
                                                        @break
                                                    @case('delivered')
                                                        <span class="badge bg-success-subtle text-success">تحویل داده شده</span>
                                                        @break
                                                @endswitch
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>وزن:</strong></td>
                                            <td>{{ number_format($shipment->weight, 2) }} کیلوگرم</td>
                                        </tr>
                                        <tr>
                                            <td><strong>ارزش اعلامی:</strong></td>
                                            <td>{{ number_format($shipment->declared_value) }} ریال</td>
                                        </tr>
                                        <tr>
                                            <td><strong>تاریخ ایجاد:</strong></td>
                                            <td>{{ jdate($shipment->created_at)->format('Y/m/d H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Sender & Receiver Information -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light-subtle">
                                    <h5 class="card-title mb-0">اطلاعات فرستنده و گیرنده</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td colspan="2" class="bg-light fw-bold">فرستنده</td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><strong>نام:</strong></td>
                                            <td>{{ $shipment->sender_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>تلفن:</strong></td>
                                            <td>{{ $shipment->sender_phone }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-light fw-bold">گیرنده</td>
                                        </tr>
                                        <tr>
                                            <td><strong>نام:</strong></td>
                                            <td>{{ $shipment->reciver_name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>تلفن:</strong></td>
                                            <td>{{ $shipment->reciver_phone }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="col-12 mt-3">
                            <div class="card">
                                <div class="card-header bg-light-subtle">
                                    <h5 class="card-title mb-0">اطلاعات تکمیلی</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td width="40%"><strong>کاربر:</strong></td>
                                                    <td>{{ $shipment->user->name }} ({{ $shipment->user->email }})</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>سفر:</strong></td>
                                                    <td>سفر شماره {{ $shipment->trip_id }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            @if($shipment->description)
                                                <strong>توضیحات:</strong>
                                                <p class="text-muted mt-2">{{ $shipment->description }}</p>
                                            @else
                                                <strong>توضیحات:</strong>
                                                <p class="text-muted mt-2">بدون توضیحات</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ route('admin.shipments.edit', $shipment->id) }}" class="btn btn-primary">
                            ویرایش محموله
                        </a>
                        <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">
                            بازگشت به لیست
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection