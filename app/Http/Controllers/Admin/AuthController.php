<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminLoginRequest;
use App\Models\Admin;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            return back()->with('error', trans('messages.invalid_data'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    public function check(): RedirectResponse
    {
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

    }
}
