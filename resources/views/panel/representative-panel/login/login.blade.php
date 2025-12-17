<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="utf-8"/>
    <title>
      پنل نماینده
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
</head>
<body class="authentication-bg">
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5">
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
                            ورود
                        </h2>
                        <div class="px-4">
                            <form action="{{route('representative.login')}}" method="post" role="form" class="authentication-form">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="mobile">
                                        شماره موبایل
                                    </label>
                                    <input class="form-control bg-light bg-opacity-50 border-light py-2 text-center"
                                           required id="mobile" name="mobile" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">
                                        رمزعبور
                                    </label>
                                    <input class="form-control bg-light bg-opacity-50 border-light py-2 text-center" required id="password" name="password" type="password"/>
                                </div>
                                <div class="mb-1 text-center d-grid">
                                    <button class="btn btn-danger py-2 fw-medium" type="submit">
                                        ورود
                                    </button>
                                </div>
                                <hr>
                                <div class="mb-1 text-center d-grid">
                                    <button class="btn btn-info py-2 fw-medium" type="submit">
                                        ثبت نام
                                    </button>
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
</body>
</html>
