@extends('panel.layout.layout')
@section('title')
    مدارک نماینده :: {{ $representative->fullname }}
@endsection
@section('breadcrumb')
    مدارک نماینده :: {{ $representative->fullname }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        مدارک هویتی نماینده :: {{ $representative->fullname }}
                    </h5>
                    <hr>

                    <form action="{{ route('representative.documents.store') }}" method="post" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">تصویر روی کارت ملی</h6>

                                        @if($representative->hasMedia('national_card_front'))
                                            <div class="mb-3">
                                                <img src="{{ $representative->getFirstMediaUrl('national_card_front') }}"
                                                     alt="روی کارت ملی"
                                                     class="img-thumbnail"
                                                     style="max-height: 200px;">
                                                <div class="mt-2">
                                                    <a href="{{ $representative->getFirstMediaUrl('national_card_front') }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-info">
                                                        مشاهده تصویر
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete('national_card_front')">
                                                        حذف
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <input type="file"
                                                   class="form-control"
                                                   id="national_card_front"
                                                   name="national_card_front"
                                                   accept="image/jpeg">
                                            @error('national_card_front')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted">فرمت‌های مجاز: JPEG  - حداکثر حجم: 2MB</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">تصویر پشت کارت ملی</h6>

                                        @if($representative->hasMedia('national_card_back'))
                                            <div class="mb-3">
                                                <img src="{{ $representative->getFirstMediaUrl('national_card_back') }}"
                                                     alt="پشت کارت ملی"
                                                     class="img-thumbnail"
                                                     style="max-height: 200px;">
                                                <div class="mt-2">
                                                    <a href="{{ $representative->getFirstMediaUrl('national_card_back') }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-info">
                                                        مشاهده تصویر
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete('national_card_back')">
                                                        حذف
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <input type="file"
                                                   class="form-control"
                                                   id="national_card_back"
                                                   name="national_card_back"
                                                   accept="image/jpeg">
                                            @error('national_card_back')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted">فرمت‌های مجاز: JPEG  - حداکثر حجم: 2MB</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">سلفی با کارت ملی</h6>

                                        @if($representative->hasMedia('selfie_with_card'))
                                            <div class="mb-3">
                                                <img src="{{ $representative->getFirstMediaUrl('selfie_with_card') }}"
                                                     alt="سلفی با کارت ملی"
                                                     class="img-thumbnail"
                                                     style="max-height: 200px;">
                                                <div class="mt-2">
                                                    <a href="{{ $representative->getFirstMediaUrl('selfie_with_card') }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-info">
                                                        مشاهده تصویر
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete('selfie_with_card')">
                                                        حذف
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <input type="file"
                                                   class="form-control"
                                                   id="selfie_with_card"
                                                   name="selfie_with_card"
                                                   accept="image/jpeg">
                                            @error('selfie_with_card')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted">فرمت‌های مجاز: JPEG  - حداکثر حجم: 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">
                                ذخیره مدارک
                            </button>
                        </div>
                    </form>

                    @if($representative->hasMedia('national_card_front'))
                        <form id="delete-national_card_front"
                              action="{{ route('representative.documents.destroy', [ 'national_card_front']) }}"
                              method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif

                    @if($representative->hasMedia('national_card_back'))
                        <form id="delete-national_card_back"
                              action="{{ route('representative.documents.destroy', [ 'national_card_back']) }}"
                              method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif

                    @if($representative->hasMedia('selfie_with_card'))
                        <form id="delete-selfie_with_card"
                              action="{{ route('representative.documents.destroy', [ 'selfie_with_card']) }}"
                              method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(collectionName) {
            if (confirm('آیا از حذف این تصویر مطمئن هستید؟')) {
                document.getElementById('delete-' + collectionName).submit();
            }
        }
    </script>
@endsection
