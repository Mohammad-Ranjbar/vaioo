@extends('panel.layout.layout')
@section('title')
    ویرایش نماینده :: {{ $representative->fullname }}
@endsection
@section('breadcrumb')
    ویرایش نماینده :: {{ $representative->fullname }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ویرایش نماینده :: {{ $representative->fullname }}
                    </h5>
                    <hr>

                    <form action="{{ route('admin.representatives.update', $representative->id) }}" method="post" role="form" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">نام</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name', $representative->name) }}" placeholder="نام نماینده">
                                    @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="family" class="form-label">نام خانوادگی</label>
                                    <input type="text" class="form-control" id="family" name="family"
                                           value="{{ old('family', $representative->family) }}" placeholder="نام خانوادگی نماینده">
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
                                    <input type="text" class="form-control" id="national_code" name="national_code"
                                           value="{{ old('national_code', $representative->national_code) }}" placeholder="کد ملی" required>
                                    @error('national_code')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="passport_number" class="form-label">شماره پاسپورت</label>
                                    <input type="text" class="form-control" id="passport_number" name="passport_number"
                                           value="{{ old('passport_number', $representative->passport_number) }}" placeholder="شماره پاسپورت">
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
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                           value="{{ old('mobile', $representative->mobile) }}" placeholder="09xxxxxxxxx" required>
                                    @error('mobile')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">ایمیل</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email', $representative->email) }}" placeholder="example@email.com">
                                    @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">رمز عبور جدید</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">در صورت عدم تغییر رمز عبور، این فیلد را خالی بگذارید.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">تکرار رمز عبور جدید</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                           name="password_confirmation" placeholder="تکرار رمز عبور جدید">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="birth_date" class="form-label">تاریخ تولد</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                                           value="{{ old('birth_date', $representative->birth_date ) }}">
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
                                    @if($representative->profile_image)
                                        <div class="mt-2">
                                            <img src="{{ $representative->image_url }}" alt="تصویر پروفایل" class="img-thumbnail" width="100">
                                            <div class="form-check mt-1">
                                                <input class="form-check-input" type="checkbox" id="remove_profile_image" name="remove_profile_image" value="1">
                                                <label class="form-check-label" for="remove_profile_image">
                                                    حذف تصویر پروفایل
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="verification_status" class="form-label">وضعیت تایید</label>
                                    <select class="form-select" id="verification_status" name="verification_status">
                                        <option value="pending" {{ old('verification_status', $representative->verification_status) == 'pending' ? 'selected' : '' }}>در انتظار تایید</option>
                                        <option value="approved" {{ old('verification_status', $representative->verification_status) == 'approved' ? 'selected' : '' }}>تایید شده</option>
                                        <option value="rejected" {{ old('verification_status', $representative->verification_status) == 'rejected' ? 'selected' : '' }}>رد شده</option>
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
                                        <option value="1" {{ old('is_active', $representative->is_active) ? 'selected' : '' }}>فعال</option>
                                        <option value="0" {{ !old('is_active', $representative->is_active) ? 'selected' : '' }}>غیرفعال</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="mobile_verified" name="mobile_verified" value="1"
                                            {{ old('mobile_verified', $representative->mobile_verified_at) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mobile_verified">
                                            موبایل تایید شده
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified" value="1"
                                            {{ old('email_verified', $representative->email_verified_at) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="email_verified">
                                            ایمیل تایید شده
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="verification_rejection_reason" class="form-label">دلیل رد تایید</label>
                            <textarea class="form-control" id="verification_rejection_reason" name="verification_rejection_reason" rows="3" placeholder="در صورت رد تایید، دلیل را وارد کنید">{{ old('verification_rejection_reason', $representative->verification_rejection_reason) }}</textarea>
                            @error('verification_rejection_reason')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            <div class="form-text">این فیلد فقط در صورت رد تایید پر می‌شود.</div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">اطلاعات سیستمی</h6>
                                            <hr>
                                            <p class="mb-1"><strong>تاریخ ایجاد:</strong>
                                                <span dir="ltr">
                                                {{ jdate($representative->created_at)->format('Y/m/d H:i') }}
                                                </span>
                                            </p>
                                            <p class="mb-1"><strong>تاریخ بروزرسانی:</strong>
                                                <span dir="ltr">
                                                {{ jdate($representative->updated_at)->format('Y/m/d H:i') }}
                                                </span>
                                            </p>
                                            @if($representative->mobile_verified_at)
                                                <p class="mb-1"><strong>تاریخ تایید موبایل:</strong>
                                                    <span dir="ltr">
                                                    {{ jdate($representative->mobile_verified_at)->format('Y/m/d H:i') }}
                                                    </span>
                                                </p>
                                            @endif
                                            @if($representative->email_verified_at)
                                                <p class="mb-1"><strong>تاریخ تایید ایمیل:</strong>
                                                    <span dir="ltr">
                                                    {{ jdate($representative->email_verified_at)->format('Y/m/d H:i') }}
                                                    </span>
                                                </p>
                                            @endif
                                            @if($representative->verified_at)
                                                <p class="mb-1"><strong>تاریخ تایید نماینده:</strong>
                                                    <span dir="ltr">
                                                    {{ jdate($representative->verified_at)->format('Y/m/d H:i') }}
                                                    </span>
                                                </p>
                                            @endif
                                            <p class="mb-1"><strong>امتیاز:</strong>
                                                {{ $representative->rating_average }} ({{ $representative->rating_count }} رأی)
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            بروزرسانی نماینده
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
