<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8"/>
    <title>
        پنل نماینده - ثبت‌نام
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="vaioo" name="description"/>
    <meta content="vaioo" name="author"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    @include('icons.icons')
    <link href="{{asset('panel/css/vendor.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('panel/css/icons.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('panel/css/app.min.css')}}" rel="stylesheet">
    <script src="{{asset('panel/js/config.min.js')}}"></script>
    <style>
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .datepicker-input {
            font-family: 'Vazir', 'Segoe UI', sans-serif;
        }
        .password-toggle {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        .field-icon {
            float: left;
            margin-left: -25px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .form-control.is-invalid {
            border-color: #dc3545;
        }
    </style>
</head>
<body class="authentication-bg">
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card auth-card">
                    @include('panel.sections.session')
                    <div class="card-body px-3 py-5">
                        <div class="mx-auto mb-4 text-center auth-logo">
                            <a class="logo-dark" href="#">
                                <img alt="logo dark"  class="w-50" src="{{asset('/panel/images/logo/logo-panel.jpeg')}}"/>
                            </a>
                            <a class="logo-light" href="#">
                                <img alt="logo light" class="w-50" src="{{asset('/panel/images/logo/logo-panel.jpeg')}}"/>
                            </a>
                        </div>
                        <h2 class="fw-bold text-uppercase text-center fs-18">
                            ثبت‌نام کاربر جدید
                        </h2>
                        <hr>
                        <div class="px-4">
                            <form action="{{route('user.register')}}" method="post" role="form" class="authentication-form" id="registerForm">
                                @csrf

                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="name">
                                            نام <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control bg-light bg-opacity-50 border-light py-2 @error('name') is-invalid @enderror"
                                               required id="name" name="name"
                                               value="{{ old('name') }}"
                                               placeholder="نام خود را وارد کنید" />
                                        @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="family">
                                            نام خانوادگی <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control bg-light bg-opacity-50 border-light py-2 @error('family') is-invalid @enderror"
                                               required id="family" name="family"
                                               value="{{ old('family') }}"
                                               placeholder="نام خانوادگی خود را وارد کنید" />
                                        @error('family')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- اطلاعات تماس -->
                                <div class="row mb-4">
                                    <h6 class="text-muted mb-3 border-bottom pb-2">اطلاعات تماس</h6>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="mobile">
                                            شماره موبایل <span class="text-danger">*</span>
                                        </label>
                                        <input class="form-control bg-light bg-opacity-50 border-light py-2 text-center @error('mobile') is-invalid @enderror"
                                               required id="mobile" name="mobile"
                                               value="{{ old('mobile') }}"
                                               placeholder="۰۹۱۲۱۲۳۴۵۶۷"
                                               pattern="09\d{9}" title="شماره موبایل باید با ۰۹ شروع شود و ۱۱ رقم باشد" />
                                        @error('mobile')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="email">
                                            ایمیل
                                        </label>
                                        <input type="email"
                                               class="form-control bg-light bg-opacity-50 border-light py-2 @error('email') is-invalid @enderror"
                                               id="email" name="email"
                                               value="{{ old('email') }}"
                                               placeholder="example@domain.com" />
                                        @error('email')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- رمز عبور -->
                                <div class="row mb-4">
                                    <h6 class="text-muted mb-3 border-bottom pb-2">رمز عبور</h6>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="password">
                                            رمزعبور <span class="text-danger">*</span>
                                        </label>
                                        <div class="position-relative">
                                            <input class="form-control bg-light bg-opacity-50 border-light py-2 @error('password') is-invalid @enderror"
                                                   required id="password" name="password" type="password"
                                                   placeholder="حداقل ۸ کاراکتر" minlength="8" />
                                            <span class="field-icon" onclick="togglePassword('password', 'togglePassword')">
                                                <i class="mdi mdi-eye-off" id="togglePassword"></i>
                                            </span>
                                        </div>
                                        <small class="text-muted">رمز عبور باید حداقل ۸ کاراکتر باشد</small>
                                        @error('password')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="password_confirmation">
                                            تکرار رمزعبور <span class="text-danger">*</span>
                                        </label>
                                        <div class="position-relative">
                                            <input class="form-control bg-light bg-opacity-50 border-light py-2 @error('password_confirmation') is-invalid @enderror"
                                                   required id="password_confirmation" name="password_confirmation"
                                                   type="password" placeholder="تکرار رمزعبور" />
                                            <span class="field-icon" onclick="togglePassword('password_confirmation', 'togglePasswordConfirm')">
                                                <i class="mdi mdi-eye-off" id="togglePasswordConfirm"></i>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- توافق‌نامه -->
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror"
                                               id="terms" name="terms"
                                                {{ old('terms') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="terms">
                                            با <a href="#" class="text-danger">شرایط و قوانین</a> سایت موافقم
                                            <span class="text-danger">*</span>
                                        </label>
                                        @error('terms')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" class="form-check-input @error('privacy') is-invalid @enderror"
                                               id="privacy" name="privacy"
                                                {{ old('privacy') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="privacy">
                                            با <a href="#" class="text-danger">حریم خصوصی</a> سایت موافقم
                                            <span class="text-danger">*</span>
                                        </label>
                                        @error('privacy')
                                        <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- دکمه‌های اقدام -->
                                <div class="mb-3 text-center d-grid">
                                    <button class="btn btn-danger py-2 fw-medium" type="submit" id="submitBtn">
                                        ثبت‌نام نماینده
                                    </button>
                                </div>

                                <div class="mt-3 text-center">
                                    <p class="mb-0">
                                        قبلاً حساب کاربری دارید؟
                                        <a href="{{route('user.login')}}" class="text-danger fw-medium">
                                            ورود به پنل
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('panel/js/vendor.js')}}"></script>
<script src="{{asset('panel/js/app.js')}}"></script>

<script>
    // نمایش/مخفی کردن رمز عبور
    function togglePassword(fieldId, iconId) {
        var field = document.getElementById(fieldId);
        var icon = document.getElementById(iconId);

        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove('mdi-eye-off');
            icon.classList.add('mdi-eye');
        } else {
            field.type = "password";
            icon.classList.remove('mdi-eye');
            icon.classList.add('mdi-eye-off');
        }
    }

    // اعتبارسنجی فرم
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password_confirmation').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('رمز عبور و تکرار آن مطابقت ندارند');
            return false;
        }

        var submitBtn = document.getElementById('submitBtn');
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> در حال ثبت‌نام...';
        submitBtn.disabled = true;

        return true;
    });

    // اعتبارسنجی کد ملی
    document.getElementById('national_code').addEventListener('blur', function() {
        var nationalCode = this.value.trim();
        if (nationalCode.length === 10 && /^\d{10}$/.test(nationalCode)) {
            if (!isValidNationalCode(nationalCode)) {
                alert('کد ملی وارد شده معتبر نیست');
                this.focus();
            }
        }
    });

    // تابع اعتبارسنجی کد ملی
    function isValidNationalCode(code) {
        if (!/^\d{10}$/.test(code)) return false;

        // بررسی کدهای یکسان
        var sameDigits = code.split('').every(function(digit) {
            return digit === code[0];
        });
        if (sameDigits) return false;

        var check = parseInt(code[9]);
        var sum = 0;

        for (var i = 0; i < 9; i++) {
            sum += parseInt(code[i]) * (10 - i);
        }

        var remainder = sum % 11;
        var calculatedCheck = remainder < 2 ? remainder : 11 - remainder;

        return calculatedCheck === check;
    }

    // اعتبارسنجی شماره موبایل
    document.getElementById('mobile').addEventListener('blur', function() {
        var mobile = this.value.trim();
        if (mobile.length > 0 && !/^09\d{9}$/.test(mobile)) {
            alert('شماره موبایل باید با ۰۹ شروع شود و ۱۱ رقم باشد');
            this.focus();
        }
    });

    // پر کردن خودکار کدهای عددی (حذف حروف فارسی/لاتین)
    document.getElementById('national_code').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('mobile').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // تابع برای حفظ وضعیت checked تیک‌باکس‌ها
    document.addEventListener('DOMContentLoaded', function() {
        // اگر فرم قبلاً ارسال شده و خطا داشته، پیام خطاها را نشان بده
        @if($errors->any())
        // اسکرول به اولین فیلد دارای خطا
        var firstErrorField = document.querySelector('.is-invalid');
        if (firstErrorField) {
            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        @endif
    });
</script>
</body>
</html>