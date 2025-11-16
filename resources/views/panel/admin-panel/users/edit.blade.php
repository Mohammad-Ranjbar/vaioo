@extends('panel.layout.layout')
@section('title')
    ویرایش کاربر :: {{ $user->fullname }}
@endsection
@section('breadcrumb')
    ویرایش کاربر :: {{ $user->fullname }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ویرایش کاربر :: {{ $user->fullname }}
                    </h5>
                    <hr>

                    <form action="{{ route('admin.users.update', $user->id) }}" method="post" role="form">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">نام</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name', $user->name) }}" placeholder="نام کاربر">
                                    @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="family" class="form-label">نام خانوادگی</label>
                                    <input type="text" class="form-control" id="family" name="family"
                                           value="{{ old('family', $user->family) }}" placeholder="نام خانوادگی کاربر">
                                    @error('family')
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
                                           value="{{ old('mobile', $user->mobile) }}" placeholder="09xxxxxxxxx" required>
                                    @error('mobile')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">ایمیل</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email', $user->email) }}" placeholder="example@email.com">
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
                                    <label for="is_active" class="form-label">وضعیت</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="1" {{ $user->is_active ? 'selected' : '' }}>فعال</option>
                                        <option value="0" {{ !$user->is_active ? 'selected' : '' }}>غیرفعال</option>
                                    </select>
                                </div>
                            </div>
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
                                                {{ jdate($user->created_at)->format('Y/m/d H:i') }}
                                                </span>
                                            </p>
                                            <p class="mb-1"><strong>تاریخ بروزرسانی:</strong>
                                                <span dir="ltr">
                                                         {{ jdate($user->updated_at)->format('Y/m/d H:i') }}
                                                </span>

                                            </p>
                                            @if($user->mobile_verified_at)
                                                <p class="mb-1"><strong>تاریخ تایید موبایل:</strong>
                                                    <span dir="ltr">
                                                    {{ jdate($user->mobile_verified_at)->format('Y/m/d H:i') }}
                                                    </span>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            بروزرسانی کاربر
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            بازگشت
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection