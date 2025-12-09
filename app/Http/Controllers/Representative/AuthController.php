<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminLoginRequest;
use App\Models\Representative;
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
        return view('panel.representative-panel.login.login');
    }

    public function login(AdminLoginRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $admin = Representative::query()->where('mobile', $validatedData['mobile'])->first();

            if (Hash::check($validatedData['password'], $admin->getAttribute('password'))) {
                Auth::guard('representative')->login($admin);
                return redirect()->route('representative.dashboard');
            }
            return back()->with('error', trans('messages.invalid_data'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    public function check(): RedirectResponse
    {
        return redirect()->route('representative.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::guard('representative')->logout();
        return redirect()->route('representative.login');

    }
}
