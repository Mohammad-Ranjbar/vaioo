<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        View::composer('panel.*', function ($view) {
            $auth = false;
            $logoutUrl = '';
            if (Auth::guard('admin')->check() && request()->routeIs('admin.*')) {
                $auth = Admin::query()->find(Auth::guard('admin')->id());
                $logoutUrl = route('admin.logout');
            }
            if (Auth::guard('representative')->check() && request()->routeIs('representative.*')) {
                $auth = Representative::query()->find(Auth::guard('representative')->id());
                $logoutUrl = route('representative.logout');
            }
            if (Auth::guard()->check() && request()->routeIs('user.*')) {
                $auth = User::query()->find(Auth::guard()->id());
                $logoutUrl = route('user.logout');
            }
            return $view->with(['auth' => $auth, 'logoutUrl' => $logoutUrl]);
        });
    }

    public function boot(): void
    {
        //
    }
}
