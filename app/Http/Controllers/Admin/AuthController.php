<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function loginPage(): Factory|View
    {
        return view('panel.admin-panel.login.login');
    }

    public function login(AdminLoginRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $admin = Admin::query()->where('mobile', $validatedData['mobile'])->first();

            if (Hash::check($validatedData['password'], $admin->getAttribute('password'))) {
                Auth::guard('admin')->login($admin);
                return redirect()->route('admin.dashboard');
            }
            return back()->with('error', trans('invalid_data'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

    }

    public function check()
    {
        return redirect()->route('admin.dashboard');
    }
}
