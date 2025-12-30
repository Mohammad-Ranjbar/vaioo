@extends('panel.layout.layout')
@section('title')
    ویرایش محموله
@endsection
@section('breadcrumb')
    ویرایش محموله
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-1 anchor" id="basic">
                        ویرایش محموله - {{ $shipment->tracking_code }}
                    </h5>
                    <hr>
                    <form action="{{ route('admin.shipments.update', $shipment->id) }}" method="post" role="form">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="trip_id" class="form-label">
                                سفر <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('trip_id') is-invalid @enderror"
                                    id="trip_id" name="trip_id" required>
                                <option value="" class="d-none">-- انتخاب سفر --</option>
                                @foreach($trips as $trip)
                                    <option value="{{ $trip->id }}"
                                            {{ old('trip_id', $shipment->trip_id) == $trip->id ? 'selected' : '' }}>
                                      {{ $trip->full_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('trip_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">
                                کاربر <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('user_id') is-invalid @enderror"
                                    id="user_id" name="user_id" required>
                                <option value="" class="d-none">-- انتخاب کاربر --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                            {{ old('user_id', $shipment->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
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
                                           value="{{ old('sender_name', $shipment->sender_name) }}" required>
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
                                           value="{{ old('sender_phone', $shipment->sender_phone) }}" required>
                                    @error('sender_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Receiver Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="receiver_name">
                                        نام گیرنده <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" dir="rtl" id="receiver_name" name="receiver_name"
                                           class="form-control text-right @error('receiver_name') is-invalid @enderror"
                                           value="{{ old('receiver_name', $shipment->receiver_name) }}" required>
                                    @error('receiver_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="receiver_phone">
                                        تلفن گیرنده <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" dir="ltr" id="receiver_phone" name="receiver_phone"
                                           class="form-control text-left @error('receiver_phone') is-invalid @enderror"
                                           value="{{ old('receiver_phone', $shipment->receiver_phone) }}" required>
                                    @error('receiver_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Package Details -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="weight">
                                        وزن (کیلوگرم) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" step="0.01" id="weight" name="weight"
                                           class="form-control @error('weight') is-invalid @enderror"
                                           value="{{ old('weight', $shipment->weight) }}" required>
                                    @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="declared_value">
                                        ارزش اعلامی (ریال) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" id="declared_value" name="declared_value"
                                           class="form-control @error('declared_value') is-invalid @enderror"
                                           value="{{ old('declared_value', $shipment->declared_value) }}" required>
                                    @error('declared_value')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label" for="description">
                                توضیحات
                            </label>
                            <textarea dir="rtl" id="description" name="description"
                                      class="form-control text-right @error('description') is-invalid @enderror"
                                      rows="3">{{ old('description', $shipment->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">
                                وضعیت <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="pending" {{ old('status', $shipment->status) == 'pending' ? 'selected' : '' }}>در انتظار</option>
                                <option value="accepted" {{ old('status', $shipment->status) == 'accepted' ? 'selected' : '' }}>پذیرفته شده</option>
                                <option value="picked_up" {{ old('status', $shipment->status) == 'picked_up' ? 'selected' : '' }}>تحویل گرفته شده</option>
                                <option value="in_transit" {{ old('status', $shipment->status) == 'in_transit' ? 'selected' : '' }}>در حال انتقال</option>
                                <option value="delivered" {{ old('status', $shipment->status) == 'delivered' ? 'selected' : '' }}>تحویل داده شده</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            بروزرسانی محموله
                        </button>
                        <a href="{{ route('admin.shipments.index') }}" class="btn btn-secondary">
                            بازگشت
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
