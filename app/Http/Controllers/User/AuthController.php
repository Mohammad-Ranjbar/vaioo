<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminLoginRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function loginPage(): Factory|View
    {
        return view('panel.user-panel.login.login');
    }

    public function registerPage(): Factory|View
    {
        return view('panel.user-panel.register.register');
    }

    public function register(RegisterUserRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            User::query()->create($request->validated());

            DB::commit();

            return redirect()->route('user.login')
                ->with('success', trans('messages.created'));

        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Representative registration failed: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $request->except(['password', 'password_confirmation'])
            ]);

            return back()->withInput()
                ->with('error', 'خطایی در ثبت‌نام رخ داده است. لطفاً مجدداً تلاش کنید.');
        }
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $user = User::query()->where('mobile', $validatedData['mobile'])->first();
            if (!$user) {
                return back()->with('error', trans('messages.account_not_found'));
            }
            if (!$user->getAttribute('is_active')) {
                return back()->with('error', trans('messages.not_active'));
            }
            if (Hash::check($validatedData['password'], $user->getAttribute('password'))) {
                Auth::guard()->login($user);
                return redirect()->route('user.dashboard');
            }
            return back()->with('error', trans('messages.invalid_data'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    public function check(): RedirectResponse
    {
        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::guard()->logout();
        return redirect()->route('user.login');

    }
}
