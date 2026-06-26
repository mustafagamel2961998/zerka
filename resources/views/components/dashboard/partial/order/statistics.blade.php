@php
    $countsObj = (object) $counts;

    $total = $countsObj->total ?? 0;
    $pending = $countsObj->pending_count ?? 0;
    $processing = $countsObj->processing_count ?? 0;
    $shipped = $countsObj->shipped_count ?? 0;
    $delivering = $countsObj->delivering_count ?? 0;
    $cancelled = $countsObj->cancelled_count ?? 0;
    $completed = $countsObj->completed_count ?? 0;
@endphp

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="card-title mb-2">{{ __('global.total_orders')}}</h4>
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $total }}</p>
                </div>
                <div>
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:bill-list-broken"
                            class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="card-title mb-2">{{ __('global.pending_payment') }}</h4>
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $pending }}</p>
                </div>
                <div>
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:clock-circle-broken"
                            class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="card-title mb-2">{{ __('global.in_progress') }}</h4>
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $processing }}</p>
                </div>
                <div>
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:inbox-line-broken"
                            class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="card-title mb-2">{{ __('global.order_shipped') }}</h4>
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $shipped }}</p>
                </div>
                <div>
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:box-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="card-title mb-2">{{ __('global.order_delivering') }}</h4>
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $delivering }}</p>
                </div>
                <div>
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:tram-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="card-title mb-2">{{ __('global.order_cancelled') }}</h4>
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $cancelled }}</p>
                </div>
                <div>
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                        <iconify-icon icon="solar:cart-cross-broken"
                            class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="col-md-6 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="card-title mb-2">{{ __('global.completed') }}</h4>
                    <p class="text-muted fw-medium fs-22 mb-0">{{ $completed }}</p>
                </div>
                <div>
                    <div class="avatar-md bg-primary bg-opacity-10 rounded">
                         <iconify-icon icon="solar:clipboard-check-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


