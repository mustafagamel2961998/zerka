@php
    // تحويل البيانات لـ Object لو جاية كـ Array عشان نستخدم السهم (->) براحتنا
    $countsObj = (object) $counts;
    
    $total = $countsObj->total ?? 0;
    $active = $countsObj->active_count ?? 0;
    $inactive = $countsObj->inactive_count ?? 0;
@endphp

<div class="col-md-4 col-xl-4">
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-4">
                    <div class="avatar-md bg-soft-primary text-primary rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                         <iconify-icon icon="solar:globus-bold-duotone" style="font-size: 24px;"></iconify-icon>
                    </div>
                </div>
                <div class="col-8 text-end">
                    <p class="text-muted mb-0 text-truncate">{{ __('global.total') ?? 'الإجمالي' }}</p>
                    <h3 class="text-dark mt-1 mb-0">{{ $total }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-xl-4">
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-4">
                    <div class="avatar-md bg-soft-success text-success rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                         <iconify-icon icon="solar:check-circle-bold-duotone" style="font-size: 24px;"></iconify-icon>
                    </div>
                </div>
                <div class="col-8 text-end">
                    <p class="text-muted mb-0 text-truncate">{{ \App\Enums\Status::ACTIVE->label() }}</p>
                    <h3 class="text-dark mt-1 mb-0">{{ $active }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-xl-4">
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-4">
                    <div class="avatar-md bg-soft-danger text-danger rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                         <iconify-icon icon="solar:close-circle-bold-duotone" style="font-size: 24px;"></iconify-icon>
                    </div>
                </div>
                <div class="col-8 text-end">
                    <p class="text-muted mb-0 text-truncate">{{ \App\Enums\Status::INACTIVE->label() }}</p>
                    <h3 class="text-dark mt-1 mb-0">{{ $inactive }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>