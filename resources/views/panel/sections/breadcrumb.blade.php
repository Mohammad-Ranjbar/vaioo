@php use Illuminate\Support\Facades\Route; @endphp
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="mb-0 fw-semibold">
                @yield('breadcrumb')
            </h4>
            <ol class="breadcrumb mb-0">
                @if(Route::currentRouteName() !== 'admin.dashboard')
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">
                            داشبورد
                        </a>
                    </li>
                @endif

                <li class="breadcrumb-item active">
                    @yield('breadcrumb')
                </li>
            </ol>
        </div>
    </div>
</div>
