@if(request()->routeIs('admin.*') && auth('admin')->check())
    <div class="main-nav">
        <div class="logo-box">
            <a class="logo-dark" href="{{route('admin.dashboard')}}">
                <img alt="logo sm" class="logo-sm" src="{{asset('/panel/images/logo/logo.jpeg')}}" />
                <img alt="logo dark" class="logo-lg" src="{{asset('/panel/images/logo/logo.jpeg')}}" />
            </a>
            <a class="logo-light" href="{{route('admin.dashboard')}}">
                <img alt="logo sm" class="logo-sm" src="{{asset('/panel/images/logo/logo.jpeg')}}" />
                <img alt="logo light" class="logo-lg" src="{{asset('/panel/images/logo/logo.jpeg')}}" />
            </a>
        </div>
        <button aria-label="Show Full Sidebar" class="button-sm-hover" style="transform: rotate(180deg);" type="button">
            <i class="ri-menu-2-line fs-24 button-sm-hover-icon">
            </i>
        </button>
        <div class="scrollbar" data-simplebar="">
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    منو
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <span class="nav-icon">
                         <i class="ri-home-office-line">
                         </i>
                    </span>
                        <span class="nav-text">
                         داشبورد
                    </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.policies.index')}}">
                    <span class="nav-icon">
                         <i class="ri-home-office-line">
                         </i>
                    </span>
                        <span class="nav-text">
                         سیاست های ارسال
                    </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.users.index')}}">
                    <span class="nav-icon">
                         <i class="ri-home-office-line">
                         </i>
                    </span>
                        <span class="nav-text">
                         کاربران
                    </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.representatives.index')}}">
                    <span class="nav-icon">
                         <i class="ri-home-office-line">
                         </i>
                    </span>
                        <span class="nav-text">
                         نمایندگان
                    </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.airports.index')}}">
                    <span class="nav-icon">
                         <i class="ri-home-office-line">
                         </i>
                    </span>
                        <span class="nav-text">
                         فرودگاه ها
                    </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.trips.index')}}">
                    <span class="nav-icon">
                         <i class="ri-home-office-line">
                         </i>
                    </span>
                        <span class="nav-text">
                         سفر ها
                    </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.shipments.index')}}">
                    <span class="nav-icon">
                         <i class="ri-home-office-line">
                         </i>
                    </span>
                        <span class="nav-text">
                         حمل و نقل
                    </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endif

@if(request()->routeIs('representative.*') && auth('representative')->check())
    <div class="main-nav">
        <div class="logo-box">
            <a class="logo-dark" href="{{route('admin.dashboard')}}">
                <img alt="logo sm" class="logo-sm" src="{{asset('/panel/images/logo/logo.jpeg')}}" />
                <img alt="logo dark" class="logo-lg" src="{{asset('/panel/images/logo/logo.jpeg')}}" />
            </a>
            <a class="logo-light" href="{{route('admin.dashboard')}}">
                <img alt="logo sm" class="logo-sm" src="{{asset('/panel/images/logo/logo.jpeg')}}" />
                <img alt="logo light" class="logo-lg" src="{{asset('/panel/images/logo/logo.jpeg')}}" />
            </a>
        </div>
        <button aria-label="Show Full Sidebar" class="button-sm-hover" style="transform: rotate(180deg);" type="button">
            <i class="ri-menu-2-line fs-24 button-sm-hover-icon">
            </i>
        </button>
        <div class="scrollbar" data-simplebar="">
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    منو
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.dashboard')}}">
                    <span class="nav-icon">
                         <i class="ri-home-office-line">
                         </i>
                    </span>
                        <span class="nav-text">
                         داشبورد
                    </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endif
