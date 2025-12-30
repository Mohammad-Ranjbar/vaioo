<div class="col-md-12 mb-4 message-item">
    <div class="card h-100">
        <div class="card-header bg-light-subtle border-bottom d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class=" align-items-center justify-content-center me-2">
                    {{$message->subject_full}}
                </div>
            </div>
            <div>
                <small class="text-muted" dir="ltr">
                    {{ jdate($message->created_at)->format('Y-m-d H:i') }}
                </small>
            </div>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="message-content">
                    {{$message->message}}
                </div>
            </div>
        </div>
    </div>
</div>
