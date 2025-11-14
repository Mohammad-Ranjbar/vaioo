<?php

namespace App\Http\Controllers;

use App\Models\Representative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class RepresentativeVerificationController extends Controller
{
    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function uploadDocuments(Request $request)
    {
        $request->validate([
            'national_card_front' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'national_card_back'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'selfie_with_card'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        /** @var Representative $representative */
        $representative = Auth::guard('representative')->user();

        // 3. افزودن هر فایل به کالکشن مربوطه
        if ($request->hasFile('national_card_front')) {
            $representative->addMediaFromRequest('national_card_front')
                ->toMediaCollection('national_card_front');
        }

        if ($request->hasFile('national_card_back')) {
            $representative->addMediaFromRequest('national_card_back')
                ->toMediaCollection('national_card_back');
        }

        if ($request->hasFile('selfie_with_card')) {
            $representative->addMediaFromRequest('selfie_with_card')
                ->toMediaCollection('selfie_with_card');
        }

        $representative->verification_status = 'pending';
        $representative->save();

        return response()->json(['message' => 'اسناد شما با موفقیت آپلود شد و در حال بررسی است.'], 200);
    }

}
