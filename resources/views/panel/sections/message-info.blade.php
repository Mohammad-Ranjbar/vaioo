<div class="card mb-4">
    <div class="card-header bg-light-subtle border-bottom d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">
            <iconify-icon icon="solar:box-broken" class="align-middle me-2"></iconify-icon>
            اطلاعات محموله
        </h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label text-muted">کد رهگیری</label>
                <div class="fw-semibold d-flex align-items-center">
                    <iconify-icon icon="solar:qr-code-broken" class="text-primary me-2"></iconify-icon>
                    {{ $shipment->tracking_code }}
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label text-muted">وضعیت</label>
                <div>
                    {{ trans('messages.'.$shipment->status )}}
                </div>
            </div>
            @if($shipment->trip)
                <div class="col-md-3 mb-3">
                    <label class="form-label text-muted">سفر مرتبط</label>
                    <div class="fw-semibold d-flex align-items-center">
                        {{ $shipment->trip->sourceAirport->name_fa }}
                        -->
                        {{ $shipment->trip->destinationAirport->name_fa }}
                    </div>
                </div>
            @endif
            <div class="col-md-3 mb-3">
                <label class="form-label text-muted">تاریخ ایجاد</label>
                <div class="fw-semibold d-flex align-items-center">
                    <iconify-icon icon="solar:calendar-broken" class="text-success me-2"></iconify-icon>
                    <span dir="ltr">
                        {{ jdate($shipment->created_at)->format('Y-m-d H:i') }}
                    </span>
                </div>
            </div>
        </div>
        @if($shipment->description)
            <div class="row border p-2">
                <div class="col-12">
                    <label class="form-label text-muted">توضیحات</label>
                    <hr>
                    <p class="mb-0">{{ $shipment->description }}</p>
                </div>
            </div>
        @endif
    </div>
</div>
