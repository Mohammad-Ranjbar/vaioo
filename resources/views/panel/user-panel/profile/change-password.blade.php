@extends('panel.layout.layout')
@section('title')
    تغییر گذرواژه کاربران
@endsection
@section('breadcrumb')
    تغییر گذرواژه کاربران

@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        تغییر گذرواژه کاربر :: {{ $user->fullname }}
                    </h5>
                    <hr>

                    <form action="{{ route('user.set-password') }}" method="post" role="form">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">رمز عبور فعلی</label>
                                    <input  class="form-control" id="current_password" name="current_password" type="password">
                                    @error('current_password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label"> رمز عبور جدید</label>
                                    <input  class="form-control" id="password" type="password"
                                           name="password">
                                    @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">تکرار رمز عبور جدید</label>
                                    <input  class="form-control" id="password_confirmation" type="password"
                                            name="password_confirmation">
                                    @error('password_confirmation')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success">
                            ثبت
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
