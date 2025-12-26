<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Profile\SetPasswordRequest;
use App\Http\Requests\User\Profile\SetProfileRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function getProfile(): Factory|View
    {
        $user = User::query()->find(Auth::id());
        return view('panel.user-panel.profile.profile',compact('user'));
    }

    public function setProfile(SetProfileRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            $user = User::query()->find(Auth::id());

            $user->update($validatedData);

            return back()->with('success', trans('messages.updated'));
        } catch (Exception $exception) {
            return back()->with("error", $exception->getMessage());
        }
    }

    public function getPassword(): Factory|View
    {
        $user = User::query()->find(Auth::id());
        return view('panel.user-panel.profile.change-password',compact('user'));
    }

    public function setPassword(SetPasswordRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            dd($validatedData);
            $user = User::query()->find(Auth::id());

            $user->update($validatedData);

            return back()->with('success', trans('messages.updated'));
        } catch (Exception $exception) {
            return back()->with("error", $exception->getMessage());
        }
    }
}
