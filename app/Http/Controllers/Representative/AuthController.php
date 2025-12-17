<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminLoginRequest;
use App\Http\Requests\Representative\RegisterRepresentativeRequest;
use App\Models\Representative;
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
        return view('panel.representative-panel.login.login');
    }

    public function registerPage(): Factory|View
    {
        return view('panel.representative-panel.register.register');
    }

    public function register(RegisterRepresentativeRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
             Representative::query()->create($request->validated());

            DB::commit();

            return redirect()->route('representative.login')
                ->with('success', 'ثبت‌نام شما با موفقیت انجام شد. پس از تأیید مدیر سیستم می‌توانید وارد شوید.');

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

    public function login(AdminLoginRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $representative = Representative::query()->where('mobile', $validatedData['mobile'])->first();
            if (!$representative) {
                return back()->with('error', trans('messages.account_not_found'));
            }
            if (!$representative->getAttribute('is_active')) {
                return back()->with('error', trans('messages.not_active'));
            }
            if (Hash::check($validatedData['password'], $representative->getAttribute('password'))) {
                Auth::guard('representative')->login($representative);
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
