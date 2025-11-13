<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePolicyRequest;
use App\Http\Requests\UpdatePolicyRequest;
use App\Models\Policy;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Exception;
use Illuminate\Http\RedirectResponse;

class PolicyController extends Controller
{
    public function index(): Factory|View
    {
        $policies = Policy::query()->latest()->paginate(20);
        return view('panel.pages.policies.index', compact('policies'));
    }

    public function create()
    {
        //
    }

    public function store(StorePolicyRequest $request)
    {
        //
    }

    public function show(Policy $policy)
    {
        //
    }

    public function edit(Policy $policy): Factory|View
    {
        return view('panel.pages.policies.edit', compact('policy'));
    }

    public function update(UpdatePolicyRequest $request, Policy $policy): RedirectResponse
    {
        try {
            $policy->update($request->validated());

            return redirect()->route('admin.policies.index')->with('success', trans('updated'));
        } catch (Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function destroy(Policy $policy): RedirectResponse
    {
        try {
            $policy->delete();

            return redirect()->route('admin.policies.index')->with('success', trans('deleted'));
        }catch (Exception $exception){
            return back()->with('error', $exception->getMessage());
        }
    }
}
