@extends('panel.layout.layout')
@section('title')
    ایجاد کاربر
@endsection
@section('breadcrumb')
    ایجاد کاربر
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ایجاد کاربر
                    </h5>
                    <hr>

                    <form action="{{route('admin.users.store')}}" method="post" role="form">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">نام</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="نام کاربر">
                                    @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="family" class="form-label">نام خانوادگی</label>
                                    <input type="text" class="form-control" id="family" name="family" value="{{ old('family') }}" placeholder="نام خانوادگی کاربر">
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
                                    <label for="is_active" class="form-label">وضعیت</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="1" selected>فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            ثبت کاربر
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection