<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRepresentativeDocumentRequest;
use App\Http\Requests\StoreRepresentativeRequest;
use App\Http\Requests\UpdateRepresentativeRequest;
use App\Models\Representative;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RepresentativeController extends Controller
{

    public function index(): Factory|View
    {
        $representatives = Representative::query()->latest('id')->paginate(25);

        return view('panel.admin-panel.representatives.index', compact('representatives'));
    }

    public function store(StoreRepresentativeRequest $request): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('profile_image')) {
                $validated['profile_image'] = $request->file('profile_image')->store('profiles/representatives', 'public');
            }

            $validated['rating_average'] = 0.00;
            $validated['rating_count'] = 0;

            Representative::query()->create($validated);

            return redirect()->route('admin.representatives.index')
                ->with('success', 'نماینده با موفقیت ایجاد شد.');

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function create(): Factory|View
    {
        return view('panel.admin-panel.representatives.create');

    }

    public function show(Representative $representative)
    {
        return view('panel.admin-panel.representatives.show', compact('representative'));
    }


    public function edit(Representative $representative): Factory|View
    {
        return view('panel.admin-panel.representatives.edit', compact('representative'));
    }

    public function update(UpdateRepresentativeRequest $request, Representative $representative): Redirector|RedirectResponse
    {
        try {
            $validated = $request->validated();
            if (empty($validated['password'])) {
                unset($validated['password']);
            } else {
                $validated['password'] = Hash::make($validated['password']);
            }

            if ($request->hasFile('profile_image')) {
                if ($representative->getAttribute('profile_image')) {
                    Storage::disk('public')->delete($representative->getAttribute('profile_image'));
                }
                $validated['profile_image'] = $request->file('profile_image')->store('profiles/representatives', 'public');
            }

            // Handle remove profile image
            if ($request->has('remove_profile_image') && $request->input('remove_profile_image')) {
                if ($representative->getAttribute('profile_image')) {
                    Storage::disk('public')->delete($representative->getAttribute('profile_image'));
                }
                $validated['profile_image'] = null;
            }

            unset($validated['password_confirmation']);
            unset($validated['remove_profile_image']);
            unset($validated['mobile_verified']);
            unset($validated['email_verified']);

            $representative->update($validated);

            return redirect(route('admin.representatives.index'))->with('success', trans('created'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }


    public function destroy(Representative $representative): Redirector|RedirectResponse
    {
        try {
            if ($representative->getAttribute('profile_image')) {
                Storage::disk('public')->delete($representative->getAttribute('profile_image'));
            }
            $representative->delete();

            return redirect(route('admin.representatives.index'))->with('success', trans('created'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
