@extends('panel.layout.layout')
@section('title')
    ایجاد فرودگاه
@endsection
@section('breadcrumb')
    ایجاد فرودگاه
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ایجاد فرودگاه
                    </h5>
                    <hr>

                    <form action="{{ route('admin.airports.store') }}" method="post" role="form">
                        @csrf

                        <!-- Persian Name (Required) -->
                        <div class="mb-3">
                            <label class="form-label" for="name_fa">
                                نام فارسی <span class="text-danger">*</span>
                            </label>
                            <input type="text" dir="rtl" id="name_fa" name="name_fa"
                                   class="form-control text-right @error('name_fa') is-invalid @enderror"
                                   value="{{ old('name_fa') }}" required>
                            @error('name_fa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="name_en">
                                نام انگلیسی <span class="text-danger">*</span>
                            </label>
                            <input type="text" dir="ltr" id="name_en" name="name_en"
                                   class="form-control text-left @error('name_en') is-invalid @enderror"
                                   value="{{ old('name_en') }}" required>
                            @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="code">
                                کد فرودگاه <span class="text-danger">*</span>
                            </label>
                            <input type="text" dir="ltr" id="code" name="code"
                                   class="form-control text-left @error('code') is-invalid @enderror"
                                   value="{{ old('code') }}" style="text-transform: uppercase;"
                                   maxlength="3" required>
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">کد IATA فرودگاه (3 حرفی)</small>
                        </div>

                        <div class="mb-3">
                            <label for="country_id" class="form-label">
                                کشور <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('country_id') is-invalid @enderror"
                                    id="country_id" name="country_id" required>
                                <option value="">-- انتخاب کشور --</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name_fa ?? $country->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status (Required) -->
                        <div class="mb-3">
                            <label for="is_active" class="form-label">
                                وضعیت <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('is_active') is-invalid @enderror"
                                    id="is_active" name="is_active" required>
                                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>فعال</option>
                                <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>غیرفعال</option>
                            </select>
                            @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            ثبت فرودگاه
                        </button>
                        <a href="{{ route('admin.airports.index') }}" class="btn btn-secondary">
                            بازگشت
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
