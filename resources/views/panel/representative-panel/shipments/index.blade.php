@extends('panel.layout.layout')
@section('title')
    محموله ها
@endsection
@section('breadcrumb')
    محموله ها
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title">
                            محموله ها
                        </h4>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap text-center table-hover table-centered mb-0">
                            <thead class="bg-light-subtle">
                            <tr>
                                <th>کد رهگیری</th>
                                <th>فرستنده</th>
                                <th>گیرنده</th>
                                <th>وزن (kg)</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>
                                <th>تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shipments as $shipment)
                                <tr>
                                    <td>
                                        <code>{{$shipment->tracking_code}}</code>
                                    </td>
                                    <td>
                                        {{$shipment->sender_name}}
                                    </td>
                                    <td>
                                        {{$shipment->reciver_name}}
                                    </td>
                                    <td>
                                        {{number_format($shipment->weight, 2)}}
                                    </td>
                                    <td>
                                        @switch($shipment->status)
                                            @case('pending')
                                                <span class="badge bg-warning-subtle text-warning py-1 px-2 fs-13">
                                                    در انتظار
                                                </span>
                                                @break
                                            @case('accepted')
                                                <span class="badge bg-info-subtle text-info py-1 px-2 fs-13">
                                                    پذیرفته شده
                                                </span>
                                                @break
                                            @case('picked_up')
                                                <span class="badge bg-primary-subtle text-primary py-1 px-2 fs-13">
                                                    تحویل گرفته شده
                                                </span>
                                                @break
                                            @case('in_transit')
                                                <span class="badge bg-secondary-subtle text-secondary py-1 px-2 fs-13">
                                                    در حال انتقال
                                                </span>
                                                @break
                                            @case('delivered')
                                                <span class="badge bg-success-subtle text-success py-1 px-2 fs-13">
                                                    تحویل داده شده
                                                </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td dir="ltr">
                                        {{jdate($shipment->created_at)}}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a class="btn btn-soft-primary btn-sm"
                                               href="{{route('representative.shipments.edit',$shipment->id)}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:pen-2-broken"></iconify-icon>
                                            </a>

                                            <a class="btn btn-soft-info btn-sm"
                                               href="{{route('representative.shipments.show',$shipment->id)}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:eye-broken"></iconify-icon>
                                            </a>

                                            <button type="button" class="btn btn-soft-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{$shipment->id}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:trash-bin-minimalistic-2-broken"></iconify-icon>
                                            </button>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('panel.sections.pagination',['paginator' => $shipments])
            </div>
        </div>
    </div>
@endsection
