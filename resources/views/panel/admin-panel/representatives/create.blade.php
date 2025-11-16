@extends('panel.layout.layout')
@section('title')
    ایجاد نماینده
@endsection
@section('breadcrumb')
    ایجاد نماینده
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ایجاد نماینده
                    </h5>
                    <hr>

                    <form action="{{ route('admin.representatives.store') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">نام</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="نام نماینده">
                                    @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="family" class="form-label">نام خانوادگی</label>
                                    <input type="text" class="form-control" id="family" name="family" value="{{ old('family') }}" placeholder="نام خانوادگی نماینده">
                                    @error('family')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="national_code" class="form-label">کد ملی</label>
                                    <input type="text" class="form-control" id="national_code" name="national_code" value="{{ old('national_code') }}" placeholder="کد ملی" required>
                                    @error('national_code')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="passport_number" class="form-label">شماره پاسپورت</label>
                                    <input type="text" class="form-control" id="passport_number" name="passport_number" value="{{ old('passport_number') }}" placeholder="شماره پاسپورت">
                                    @error('passport_number')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">موبایل</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="09xxxxxxxxx" required>
                                    @error('mobile')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">ایمیل</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="example@email.com">
                                    @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">رمز عبور</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">تکرار رمز عبور</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">تاریخ تولد</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="profile_image" class="form-label">تصویر پروفایل</label>
                                    <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                    @error('profile_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="verification_status" class="form-label">وضعیت تایید</label>
                                    <select class="form-select" id="verification_status" name="verification_status">
                                        <option value="pending" selected>در انتظار تایید</option>
                                        <option value="approved">تایید شده</option>
                                        <option value="rejected">رد شده</option>
                                    </select>
                                    @error('verification_status')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">وضعیت فعال بودن</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="1" selected>فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="mobile_verified" name="mobile_verified" value="1">
                                        <label class="form-check-label" for="mobile_verified">
                                            موبایل تایید شده
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified" value="1">
                                        <label class="form-check-label" for="email_verified">
                                            ایمیل تایید شده
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="verification_rejection_reason" class="form-label">دلیل رد تایید</label>
                            <textarea class="form-control" id="verification_rejection_reason" name="verification_rejection_reason" rows="3" placeholder="در صورت رد تایید، دلیل را وارد کنید">{{ old('verification_rejection_reason') }}</textarea>
                            @error('verification_rejection_reason')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text">این فیلد فقط در صورت رد تایید پر می‌شود.</div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            ثبت نماینده
                        </button>
                        <a href="{{ route('admin.representatives.index') }}" class="btn btn-secondary">
                            بازگشت
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection