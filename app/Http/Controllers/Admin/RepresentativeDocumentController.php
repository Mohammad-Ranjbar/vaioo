<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Representative\StoreRepresentativeDocumentRequest;
use App\Models\Representative;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class RepresentativeDocumentController extends Controller
{
    public function create(Representative $representative): Factory|View
    {
        return view('panel.admin-panel.representatives.documents', compact('representative'));
    }

    public function store(StoreRepresentativeDocumentRequest $request, Representative $representative): RedirectResponse
    {
        try {
            if ($request->hasFile('national_card_front')) {
                $fileName = $this->generateFileName('national_card_front');

                $representative->addMediaFromRequest('national_card_front')
                    ->usingFileName($fileName)
                    ->toMediaCollection('national_card_front');
            }
            if ($request->hasFile('national_card_back')) {
                $fileName = $this->generateFileName('national_card_back');

                $representative->addMediaFromRequest('national_card_back')
                    ->usingFileName($fileName)
                    ->toMediaCollection('national_card_back');
            }

            if ($request->hasFile('selfie_with_card')) {
                $fileName = $this->generateFileName('selfie_with_card');

                $representative->addMediaFromRequest('selfie_with_card')
                    ->usingFileName($fileName)
                    ->toMediaCollection('selfie_with_card');
            }

            return redirect()->route('admin.representatives.documents.create', $representative->getAttribute('id'))
                ->with('success', 'مدارک با موفقیت آپلود شدند.');

        } catch (Exception $e) {
            return redirect()->back()
                ->with('error',$e->getMessage());
        }
    }

    private function generateFileName(string $collectionName): string
    {
        $prefix = match ($collectionName) {
            'national_card_front' => 'front_',
            'national_card_back' => 'back_',
            'selfie_with_card' => 'selfie_',
            default => 'file_'
        };

        return $prefix . Str::uuid() . '.jpg';
    }

    public function destroy(Representative $representative, string $collectionName): RedirectResponse
    {
        try {
            $media = $representative->getFirstMedia($collectionName);

            if ($media) {
                $media->delete();
                return redirect()->route('admin.representatives.documents.create', $representative->getAttribute('id'))
                    ->with('success', 'تصویر با موفقیت حذف شد.');
            }

            return redirect()->route('admin.representatives.documents.create', $representative->getAttribute('id'))
                ->with('error', 'تصویر یافت نشد.');

        } catch (Exception $e) {
            return redirect()->route('admin.representatives.documents.create', $representative->getAttribute('id'))
                ->with('error', 'خطا در حذف تصویر: ' . $e->getMessage());
        }
    }

    public function destroyAll(Representative $representative): RedirectResponse
    {
        try {
            $representative->clearMediaCollection('national_card_front');
            $representative->clearMediaCollection('national_card_back');
            $representative->clearMediaCollection('selfie_with_card');

            return redirect()->route('admin.representatives.documents.create', $representative->getAttribute('id'))
                ->with('success', 'تمامی مدارک با موفقیت حذف شدند.');

        } catch (Exception $e) {
            return redirect()->route('admin.representatives.documents.create', $representative->getAttribute('id'))
                ->with('error', 'خطا در حذف مدارک: ' . $e->getMessage());
        }
    }
}
