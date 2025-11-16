<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    public function index(): Factory|View
    {
        $users = User::query()->latest()->paginate(25);

        return view('panel.admin-panel.users.index', compact('users'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $validatedData = $request->validated();

            User::query()->create($validatedData);

            return redirect(route('admin.users.index'))->with('success', trans('created'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function create(): Factory|View
    {
        return view('panel.admin-panel.users.create');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user): Factory|View
    {
        return view('panel.admin-panel.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            if (empty($validatedData['password'])) {
                unset($validatedData['password']);
            }
            $user->update($validatedData);

            return redirect(route('admin.users.index'))->with('success', trans('updated'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->delete();

            return back()->with('success', trans('deleted'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
