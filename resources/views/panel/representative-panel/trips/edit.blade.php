




@extends('panel.layout.layout')
@section('title')
    ویرایش سفر
@endsection
@section('breadcrumb')
    ویرایش سفر
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ویرایش سفر
                    </h5>
                    <hr>

                    <form action="{{ route('representative.trips.update', $trip->id) }}" method="post" role="form">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="source_airport_id" class="form-label">
                                فرودگاه مبدا <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('source_airport_id') is-invalid @enderror"
                                    id="source_airport_id" name="source_airport_id" required>
                                <option value="">-- انتخاب فرودگاه مبدا --</option>
                                @foreach($airports as $airport)
                                    <option value="{{ $airport->id }}"
                                            {{ old('source_airport_id', $trip->source_airport_id) == $airport->id ? 'selected' : '' }}>
                                        {{ $airport->name_fa }} ({{ $airport->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('source_airport_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="destination_airport_id" class="form-label">
                                فرودگاه مقصد <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('destination_airport_id') is-invalid @enderror"
                                    id="destination_airport_id" name="destination_airport_id" required>
                                <option value="">-- انتخاب فرودگاه مقصد --</option>
                                @foreach($airports as $airport)
                                    <option value="{{ $airport->id }}"
                                            {{ old('destination_airport_id', $trip->destination_airport_id) == $airport->id ? 'selected' : '' }}>
                                        {{ $airport->name_fa }} ({{ $airport->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('destination_airport_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="departure_date">
                                تاریخ رفت <span class="text-danger">*</span>
                            </label>
                            <input type="date" id="departure_date" name="departure_date"
                                   class="form-control @error('departure_date') is-invalid @enderror"
                                   value="{{ old('departure_date', $trip->departure_date->toDateString()) }}" required>
                            @error('departure_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="arrival_date">
                                تاریخ برگشت <span class="text-danger">*</span>
                            </label>
                            <input type="date" id="arrival_date" name="arrival_date"
                                   class="form-control @error('arrival_date') is-invalid @enderror"
                                   value="{{ old('arrival_date', $trip->arrival_date->toDateString()) }}" required>
                            @error('arrival_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="capacity_weight">
                                ظرفیت وزن (کیلوگرم) <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" id="capacity_weight" name="capacity_weight"
                                   class="form-control @error('capacity_weight') is-invalid @enderror"
                                   value="{{ old('capacity_weight', $trip->capacity_weight) }}" required>
                            @error('capacity_weight')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="capacity_value">
                                ظرفیت ارزش <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" id="capacity_value" name="capacity_value"
                                   class="form-control @error('capacity_value') is-invalid @enderror"
                                   value="{{ old('capacity_value', $trip->capacity_value) }}" required>
                            @error('capacity_value')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">
                                وضعیت <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="planning" {{ old('status', $trip->status) == 'planning' ? 'selected' : '' }}>در حال برنامه ریزی</option>
                                <option value="in_progress" {{ old('status', $trip->status) == 'in_progress' ? 'selected' : '' }}>در جریان</option>
                                <option value="completed" {{ old('status', $trip->status) == 'completed' ? 'selected' : '' }}>تکمیل شده</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            بروزرسانی سفر
                        </button>
                        <a href="{{ route('representative.trips.index') }}" class="btn btn-secondary">
                            بازگشت
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
