<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRepresentativeRequest;
use App\Http\Requests\UpdateRepresentativeRequest;
use App\Models\Representative;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

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

    }


    public function edit(Representative $representative): Factory|View
    {
        return view('panel.admin-panel.representatives.edit', compact('representative'));
    }

    public function update(UpdateRepresentativeRequest $request, Representative $representative)
    {
        try {
            $validatedData = $request->validated();

            $representative->update($validatedData);

            return redirect(route('admin.representatives.index'))->with('success', trans('created'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Representative $representative): Redirector|RedirectResponse
    {
        try {

            $representative->delete();

            return redirect(route('admin.representatives.index'))->with('success', trans('created'));

        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
