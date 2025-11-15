<?php

namespace App\Providers;

use App\Models\Admin;
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
            if (Auth::guard('admin')->check()) {
                $auth = Admin::query()->find(Auth::guard('admin')->id());
                $logoutUrl = route('admin.logout');
            }
            return $view->with(['auth' =>  $auth, 'logoutUrl' => $logoutUrl]);
        });
    }

    public function boot(): void
    {
        //
    }
}
