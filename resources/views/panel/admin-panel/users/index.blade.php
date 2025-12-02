@extends('panel.layout.layout')
@section('title')
    کاربران
@endsection
@section('breadcrumb')
    کاربران
@endsection
@section('content')

{{--    <div class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header border-0">--}}
{{--                    <div class="row justify-content-between">--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col-lg-6">--}}
{{--                                    <form class="app-search d-none d-md-block me-auto">--}}
{{--                                        <div class="position-relative">--}}
{{--                                            <input autocomplete="off" class="form-control" placeholder="جستجو نماینده"--}}
{{--                                                   type="search" value="" />--}}
{{--                                            <iconify-icon class="search-widget-icon"--}}
{{--                                                          icon="solar:magnifer-broken"></iconify-icon>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                                <div class="col-lg-4">--}}
{{--                                    <h5 class="text-dark fw-medium mb-0">--}}
{{--                                        311--}}
{{--                                        <span class="text-muted">--}}
{{--			   نماینده--}}
{{--			  </span>--}}
{{--                                    </h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6">--}}
{{--                            <div class="text-md-end mt-3 mt-md-0">--}}
{{--                                <button class="btn btn-outline-primary me-1" type="button">--}}
{{--                                    <i class="ri-settings-2-line me-1">--}}
{{--                                    </i>--}}
{{--                                    تنظیمات بیشتر--}}
{{--                                </button>--}}
{{--                                <button class="btn btn-outline-primary me-1" type="button">--}}
{{--                                    <i class="ri-filter-line me-1">--}}
{{--                                    </i>--}}
{{--                                    فیلترها--}}
{{--                                </button>--}}
{{--                                <button class="btn btn-success me-1" type="button">--}}
{{--                                    <i class="ri-add-line">--}}
{{--                                    </i>--}}
{{--                                    نماینده جدید--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- end col-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title">
                            کاربران
                        </h4>
                    </div>
                    <div>
                        <a class="card-title btn btn-info" href="{{route('admin.users.create')}}">
                            ایجاد
                            کاربران
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap text-center table-hover table-centered mb-0">
                            <thead class="bg-light-subtle">
                            <tr>
                                <th>
                                    مشخصات
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
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{$user->fullname}}
                                    </td>

                                    <td>
                                        @if($user->is_active)
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
                                        {{jdate($user->created_at)}}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-soft-primary btn-sm"
                                               href="{{route('admin.users.edit',$user->id)}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:pen-2-broken"></iconify-icon>
                                            </a>

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{$user->id}}">
                                                <iconify-icon class="align-middle fs-18"
                                                              icon="solar:trash-bin-minimalistic-2-broken"></iconify-icon>
                                            </button>

                                            <div class="modal fade" id="delete-{{$user->id}}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">

                                                        <form action="{{route('admin.users.destroy',$user->id)}}" method="post">
                                                            <div class="modal-body">

                                                                @method('delete')
                                                                @csrf
                                                                <p>
                                                                    آیا از حذف
                                                                    <b>
                                                                        {{$user->fullname}}
                                                                    </b>
                                                                    اطمینان دارید؟
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

                    @include('panel.sections.pagination',['paginator' => $users])
            </div>
        </div>
    </div>
@endsection
