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
                    <div>
                        <a class="card-title btn btn-info" href="{{route('admin.shipments.create')}}">
                            ایجاد محموله
                        </a>
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
                                        {{$shipment->receiver_name}}
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
                                        {{jdate($shipment->created_at)->format('Y-m-d H:i')}}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">

                                            <a class="btn btn-soft-primary btn-sm"
                                               href="{{route('admin.shipments.edit',$shipment->id)}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:pen-2-broken"></iconify-icon>
                                            </a>

                                            <a class="btn btn-soft-info btn-sm"
                                               href="{{route('admin.shipments.show',$shipment->id)}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:eye-broken"></iconify-icon>
                                            </a>

                                            <button type="button" class="btn btn-soft-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{$shipment->id}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:trash-bin-minimalistic-2-broken"></iconify-icon>
                                            </button>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{$shipment->id}}" tabindex="-1"
                                                 aria-labelledby="deleteModalLabel{{$shipment->id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{route('admin.shipments.destroy',$shipment->id)}}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body text-center">
                                                                <iconify-icon icon="solar:warning-circle-broken"
                                                                              class="text-warning fs-48"></iconify-icon>
                                                                <h5 class="mt-3">آیا از حذف این محموله اطمینان
                                                                    دارید؟</h5>
                                                                <p class="text-muted">کد رهگیری:
                                                                    <strong>{{$shipment->tracking_code}}</strong></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                        data-bs-dismiss="modal">
                                                                    انصراف
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">
                                                                    حذف
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
