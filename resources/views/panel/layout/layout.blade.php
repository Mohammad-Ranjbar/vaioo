<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="utf-8" />
    <title>
        پنل
        @if(request()->routeIs('admin.*') && auth('admin')->check())
            ادمین
        @elseif(request()->routeIs('representative.*') && auth('representative')->check())
            حمل کننده
        @elseif(request()->routeIs('user.*') && auth()->check())
            فرستنده
        @endif
        ::
        @yield('title')
    </title>
    @include('panel.sections.seo')
    @include('icons.icons')
    <link href="{{asset('panel/css/vendor.min.css')}}" rel="stylesheet" />
    <link href="{{asset('panel/css/icons.min.css')}}" rel="stylesheet" />
    <link href="{{asset('panel/css/app.min.css')}}" rel="stylesheet">
    <script src="{{asset('panel/js/config.min.js')}}"></script>

</head>
<body>

<div class="wrapper">
    @include('panel.sections.header')
    @include('panel.sections.sidebar')

    <div class="page-content">
        @include('panel.sections.session')
        <div class="container-fluid">
            @include('panel.sections.breadcrumb')
            @yield('content')
        </div>
        @include('panel.sections.footer')
    </div>
</div>

<script src="{{asset('panel/js/vendor.js')}}"></script>
<script src="{{asset('panel/js/app.js')}}"></script>
<script src="{{asset('panel/vendor/jsvectormap/js/jsvectormap.min.js')}}"></script>
<script src="{{asset('panel/vendor/jsvectormap/maps/world-merc.js')}}"></script>
<script src="{{asset('panel/vendor/jsvectormap/maps/world.js')}}"></script>
<script src="{{asset('panel/js/pages/dashboard-analytics.js')}}"></script>

</body>

</html>
