@extends('panel.layout.layout')
@section('title')
    سفرها
@endsection
@section('breadcrumb')
    سفرها
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title">
                            سفرها
                        </h4>
                    </div>
                    <div>
                        <a class="card-title btn btn-info" href="{{route('admin.trips.create')}}">
                            ایجاد سفر
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap text-center table-hover table-centered mb-0">
                            <thead class="bg-light-subtle">
                            <tr>
                                <th>نماینده</th>
                                <th>فرودگاه مبدا</th>
                                <th>فرودگاه مقصد</th>
                                <th>تاریخ رفت</th>
                                <th>تاریخ برگشت</th>
                                <th>ظرفیت وزن
                                (کیلوگرم)
                                </th>
                                <th>ظرفیت ارزش
                                (تومان)
                                </th>
                                <th>وضعیت</th>
                                <th>تاریخ ایجاد</th>
                                <th>تنظیمات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trips as $trip)
                                <tr>
                                    <td>{{$trip->representative->fullname}}</td>
                                    <td>{{$trip->sourceAirport->name_fa }}</td>
                                    <td>{{$trip->destinationAirport->name_fa }}</td>
                                    <td dir="ltr">{{jdate($trip->departure_date)->format('Y-m-d')}}</td>
                                    <td dir="ltr">{{jdate($trip->arrival_date)->format('Y-m-d')}}</td>
                                    <td>{{number_format($trip->capacity_weight)}}</td>
                                    <td>{{number_format($trip->capacity_value)}}</td>
                                    <td>
                                        @if($trip->status == 'planning')
                                            <span class="badge bg-info-subtle text-info py-1 px-2 fs-13">
                                                در حال برنامه ریزی
                                            </span>
                                        @elseif($trip->status == 'in_progress')
                                            <span class="badge bg-warning-subtle text-warning py-1 px-2 fs-13">
                                                در جریان
                                            </span>
                                        @else
                                            <span class="badge bg-success-subtle text-success py-1 px-2 fs-13">
                                                تکمیل شده
                                            </span>
                                        @endif
                                    </td>
                                    <td dir="ltr">
                                        {{jdate($trip->created_at)->format('Y-m-d H:i')}}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-soft-primary btn-sm"
                                               href="{{route('admin.trips.edit',$trip->id)}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:pen-2-broken"></iconify-icon>
                                            </a>

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{$trip->id}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:trash-bin-minimalistic-2-broken"></iconify-icon>
                                            </button>

                                            <div class="modal fade" id="deleteModal{{$trip->id}}" tabindex="-1"
                                                 aria-labelledby="deleteModalLabel{{$trip->id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{route('admin.trips.destroy',$trip->id)}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <p>
                                                                    آیا از حذف سفر اطمینان دارید؟
                                                                </p>
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
                <div class="card-footer">
                    @include('panel.sections.pagination',['paginator' => $trips])
                </div>
            </div>
        </div>
    </div>
@endsection


