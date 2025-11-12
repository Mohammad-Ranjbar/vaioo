@extends('panel.layout.layout')
@section('title')
    سیاست های ارسال
@endsection
@section('breadcrumb')
    سیاست های ارسال
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row justify-content-between">
                        <div class="col-lg-6">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <form class="app-search d-none d-md-block me-auto">
                                        <div class="position-relative">
                                            <input autocomplete="off" class="form-control" placeholder="جستجو نماینده" type="search" value=""/>
                                            <iconify-icon class="search-widget-icon" icon="solar:magnifer-broken">
                                            </iconify-icon>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                    <h5 class="text-dark fw-medium mb-0">
                                        311
                                        <span class="text-muted">
			   نماینده
			  </span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-md-end mt-3 mt-md-0">
                                <button class="btn btn-outline-primary me-1" type="button">
                                    <i class="ri-settings-2-line me-1">
                                    </i>
                                    تنظیمات بیشتر
                                </button>
                                <button class="btn btn-outline-primary me-1" type="button">
                                    <i class="ri-filter-line me-1">
                                    </i>
                                    فیلترها
                                </button>
                                <button class="btn btn-success me-1" type="button">
                                    <i class="ri-add-line">
                                    </i>
                                    نماینده جدید
                                </button>
                            </div>
                        </div>
                        <!-- end col-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title">
                            لیست همه نمایندگان
                        </h4>
                    </div>
                    <div class="dropdown">
                        <a aria-expanded="false" class="dropdown-toggle btn btn-sm btn-outline-light rounded" data-bs-toggle="dropdown" href="#">
                            ماه اخیر
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#!">
                                دانلود
                            </a>
                            <!-- item-->
                            <a class="dropdown-item" href="#!">
                                خروجی
                            </a>
                            <!-- item-->
                            <a class="dropdown-item" href="#!">
                                واردی
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap table-hover table-centered mb-0">
                            <thead class="bg-light-subtle">
                            <tr>
                                <th>
                                    عکس و نام نماینده
                                </th>
                                <th>
                                    آدرس
                                </th>
                                <th>
                                    ایمیل
                                </th>
                                <th>
                                    شماره تماس
                                </th>
                                <th>
                                    تجربه کاری
                                </th>
                                <th>
                                    تاریخ
                                </th>
                                <th>
                                    وضعیت
                                </th>
                                <th>
                                    اقدام
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <img alt="" class="avatar-sm rounded-circle" src="assets/images/users/avatar-8.jpg"/>
                                        </div>
                                        <div>
                                            <a class="text-dark fw-medium fs-15" href="#!">
                                                متین قدسی
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    اصفهان، خیابان آذر، کوچه۲۳، پلاک۱۱
                                </td>
                                <td>
                                    info@matin.com
                                </td>
                                <td>
                                    ۰۹۰۱۰۰۷۰۰۱۱
                                </td>
                                <td>
                                    2 سال
                                </td>
                                <td>
                                    ۱ شهریور ۱۴۰۲
                                </td>
                                <td>
			  <span class="badge bg-success-subtle text-success py-1 px-2 fs-13">
			   فعال
			  </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class="btn btn-light btn-sm" href="#!">
                                            <iconify-icon class="align-middle fs-18" icon="solar:eye-broken">
                                            </iconify-icon>
                                        </a>
                                        <a class="btn btn-soft-primary btn-sm" href="#!">
                                            <iconify-icon class="align-middle fs-18" icon="solar:pen-2-broken">
                                            </iconify-icon>
                                        </a>
                                        <a class="btn btn-soft-danger btn-sm" href="#!">
                                            <iconify-icon class="align-middle fs-18" icon="solar:trash-bin-minimalistic-2-broken">
                                            </iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                  @include('panel.sections.pagination')
                </div>
            </div>
        </div>
    </div>
@endsection
