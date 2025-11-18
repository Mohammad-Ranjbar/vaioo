@extends('panel.layout.layout')
@section('title')
    فرودگاه ها
@endsection
@section('breadcrumb')
    فرودگاه ها
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title">
                            فرودگاه ها
                        </h4>
                    </div>
                    <div>
                        <a class="card-title btn btn-info" href="{{route('admin.airports.create')}}">
                            ایجاد
                            فرودگاه
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap text-center table-hover table-centered mb-0">
                            <thead class="bg-light-subtle">
                            <tr>
                                <th>
                                    عنوان
                                </th>
                                <th>
                                    وضعیت
                                </th>
                                <th>
                                    تاریخ
                                </th>
                                <th>
                                    تنظیمات
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($airports as $airport)
                                <tr>
                                    <td>
                                        {{$airport->name_fa}}
                                    </td>

                                    <td>
                                        @if($airport->is_active)
                                            <span class="badge bg-success-subtle text-success py-1 px-2 fs-13">
                                           فعال
                                          </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger py-1 px-2 fs-13">
                                           غیرفعال
                                          </span>
                                        @endif

                                    </td>
                                    <td dir="ltr">
                                        {{jdate($airport->created_at)}}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-soft-primary btn-sm"
                                               href="{{route('admin.airports.edit',$airport->id)}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:pen-2-broken"></iconify-icon>
                                            </a>

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:trash-bin-minimalistic-2-broken"></iconify-icon>
                                            </button>

                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <form action="{{route('admin.airports.destroy',$airport->id)}}">
                                                            <div class="modal-body">

                                                                @method('delete')
                                                                @csrf
                                                                <p>
                                                                    آیا از حذف اطمینان دارید؟
                                                                </p>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                        data-bs-dismiss="modal">
                                                                    انصراف
                                                                </button>
                                                                <button type="button" class="btn btn-danger">
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
                    @include('panel.sections.pagination',['paginator' => $airports])
                </div>
            </div>
        </div>
    </div>
@endsection
