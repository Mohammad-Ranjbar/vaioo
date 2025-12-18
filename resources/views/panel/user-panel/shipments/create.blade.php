@extends('panel.layout.layout')
@section('title')
    ایجاد محموله
@endsection
@section('breadcrumb')
    ایجاد محموله
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ایجاد محموله جدید </h5>
                    <hr>

                    <form action="{{ route('user.shipments.store') }}" method="post" role="form">
                        @csrf
                        <div class="mb-3">
                            <label for="trip_id" class="form-label">
                                سفر <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('trip_id') is-invalid @enderror" id="trip_id"
                                    name="trip_id" required>
                                <option value="" class="d-none">-- انتخاب سفر --</option>
                                @foreach($trips as $trip)
                                    <option value="{{ $trip->id }}"
                                            {{ old('trip_id') == $trip->id ? 'selected' : '' }}>
                                         {{ $trip->full_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('trip_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="sender_name">
                                        نام فرستنده <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" dir="rtl" id="sender_name" name="sender_name"
                                           class="form-control text-right @error('sender_name') is-invalid @enderror"
                                           value="{{ old('sender_name') }}" required>
                                    @error('sender_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="sender_phone">
                                        تلفن فرستنده <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" dir="ltr" id="sender_phone" name="sender_phone"
                                           class="form-control text-left @error('sender_phone') is-invalid @enderror"
                                           value="{{ old('sender_phone') }}" required>
                                    @error('sender_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="reciver_name">
                                        نام گیرنده <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" dir="rtl" id="reciver_name" name="reciver_name"
                                           class="form-control text-right @error('reciver_name') is-invalid @enderror"
                                           value="{{ old('reciver_name') }}" required>
                                    @error('reciver_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="reciver_phone">
                                        تلفن گیرنده <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" dir="ltr" id="reciver_phone" name="reciver_phone"
                                           class="form-control text-left @error('reciver_phone') is-invalid @enderror"
                                           value="{{ old('reciver_phone') }}" required>
                                    @error('reciver_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="weight">
                                        وزن (کیلوگرم) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" step="0.01" id="weight" name="weight"
                                           class="form-control @error('weight') is-invalid @enderror"
                                           value="{{ old('weight') }}" required>
                                    @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="declared_value">
                                        ارزش اعلامی (تومان) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" id="declared_value" name="declared_value"
                                           class="form-control @error('declared_value') is-invalid @enderror"
                                           value="{{ old('declared_value') }}" required>
                                    @error('declared_value')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">
                                توضیحات
                            </label>
                            <textarea dir="rtl" id="description" name="description"
                                      class="form-control text-right @error('description') is-invalid @enderror"
                                      rows="3">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            ثبت محموله
                        </button>
                        <a href="{{ route('user.shipments.index') }}" class="btn btn-secondary">
                            بازگشت
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection