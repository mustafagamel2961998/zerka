<x-dashboard.layout title="{{ __('dashboard.orders') }}">

    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <div>
                                    <h4 class="fw-medium text-dark d-flex align-items-center gap-2">
                                        #{{ $order->order_number }}
                                        <span>
                                            {{ __('global.payment_status') }} :
                                        </span>

                                        @switch($order->payment_status?->value)
                                            @case('paid')
                                                <span class="badge  bg-success text-light px-2 py-1 fs-13">
                                                    {{ __('global.paid') }}
                                                </span>
                                            @break

                                            @case('failed')
                                                <span class="badge  bg-danger text-light px-2 py-1 fs-13">
                                                    {{ __('global.failed') }}
                                                </span>
                                            @break

                                            @default
                                                <span class="badge  bg-warning text-light px-2 py-1 fs-13">
                                                    {{ __('global.pending') }}
                                                </span>
                                        @endswitch
                                        <span>
                                            {{ __('global.order_status') }} :
                                        </span>

                                        @switch($order->status?->value)
                                            @case('processing')
                                                <span class="badge border border-warning text-warning px-2 py-1 fs-13">
                                                    {{ __('global.processing') }}
                                                </span>
                                            @break

                                            @case('shipped')
                                                <span class="badge border border-primary text-primary px-2 py-1 fs-13">
                                                    {{ __('global.shipped') }}
                                                </span>
                                            @break

                                            @case('delivering')
                                                <span class="badge border border-info text-info px-2 py-1 fs-13">
                                                    {{ __('global.order_delivering') }}
                                                </span>
                                            @break

                                            @case('completed')
                                                <span class="badge border border-success text-success px-2 py-1 fs-13">
                                                    {{ __('global.completed') }}
                                                </span>
                                            @break

                                            @case('cancelled')
                                                <span class="badge border border-danger text-danger px-2 py-1 fs-13">
                                                    {{ __('global.cancelled') }}
                                                </span>
                                            @break

                                            @default
                                                <span class="badge border border-secondary text-secondary px-2 py-1 fs-13">
                                                    {{ __('global.pending') }}
                                                </span>
                                        @endswitch
                                    </h4>
                                    <div class="d-flex flex-column gap-1">
                                        <a href="#!"
                                            class="fw-bold text-primary text-decoration-none fs-15 d-inline-flex align-items-center gap-1">
                                            <i class="ri-user-line font-size-14"></i>
                                            {{ $order->user?->profile?->first_name . ' ' . $order->user?->profile?->last_name }}
                                            <span class="badge bg-light text-muted fw-normal ms-1 fs-12 border">
                                                @php
                                                    $orderTime = \Carbon\Carbon::createFromFormat(
                                                        'Y-m-d H:i:s',
                                                        $order->created_at->toDateTimeString(),
                                                        config('app_settings.timezone'),
                                                    );
                                                @endphp
                                                {{ $orderTime->diffForHumans() }}
                                            </span>
                                        </a>

                                        <p class="mb-0 text-muted fs-13 d-flex align-items-center gap-3">
                                            <span class="d-flex align-items-center gap-1">
                                                <i class="ri-calendar-todo-line text-secondary"></i>
                                                <span
                                                    class="fw-medium text-dark">{{ $order->created_at->translatedFormat('Y-m-d') }}</span>
                                            </span>

                                            <span class="d-flex align-items-center gap-1">
                                                <i class="ri-time-line text-secondary"></i>
                                                <span
                                                    class="fw-medium text-dark">{{ $order->created_at->translatedFormat('h:i A') }}</span>
                                            </span>
                                        </p>
                                    </div>

                                </div>

                                {{-- فورم إلغاء الطلب - سابمِت عادي من غير أي JS --}}
                                @if (!in_array($order->status, [\App\Enums\Order\Status::CANCELLED, \App\Enums\Order\Status::COMPLETED, \App\Enums\Order\Status::RECEIVED]))
                                    <form action="{{ route('dashboard.v1.orders.update', $order->id) }}"
                                        method="POST" class="m-0">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <iconify-icon icon="solar:close-circle-broken"
                                                class="align-middle me-1"></iconify-icon>
                                            {{ __('global.cancel_order')}}
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div class="mt-4">
                                <h4 class="fw-medium text-dark">
                                    {{ __('global.order_tracking') }}
                                </h4>
                            </div>
                            <form id="update-status-form"
                                action="{{ route('dashboard.v1.orders.update', $order->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" id="form-status-input">
                            </form>

                            @if ($order->status === \App\Enums\Order\Status::CANCELLED)
                                {{-- شكل خاص بحالة الإلغاء --}}
                                <div class="alert alert-danger d-flex align-items-center gap-2 mb-0" role="alert">
                                    <iconify-icon icon="solar:close-circle-bold" style="font-size: 24px;"></iconify-icon>
                                    <div>
                                        <h5 class="mb-1 text-danger fw-bold">
                                            {{ __('global.order_cancelled') ?? 'تم إلغاء هذا الطلب' }}
                                        </h5>
                                        <p class="mb-0 fs-13 text-muted">
                                            {{ __('global.order_cancelled_desc') ?? 'لا يمكن متابعة تتبع هذا الطلب لأنه تم إلغاؤه.' }}
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="row d-xxl-flex flex-xxl-nowrap row-cols-md-4 row-cols-2 g-3"
                                    id="order-status-steps" data-order-id="{{ $order->id }}">

                                    @php
                                        $steps = [
                                            \App\Enums\Order\Status::PENDING->value => [
                                                'label' => __('global.pending'),
                                                'color' => 'secondary',
                                            ],
                                            \App\Enums\Order\Status::PROCESSING->value => [
                                                'label' => __('global.processing'),
                                                'color' => 'warning',
                                            ],
                                            \App\Enums\Order\Status::PACKED->value => [
                                                'label' => __('global.packed') ?? 'Packed',
                                                'color' => 'dark',
                                            ],
                                            \App\Enums\Order\Status::SHIPPED->value => [
                                                'label' => __('global.order_shipped'),
                                                'color' => 'primary',
                                            ],
                                            \App\Enums\Order\Status::DELIVERING->value => [
                                                'label' => __('global.order_delivering'),
                                                'color' => 'info',
                                            ],
                                            \App\Enums\Order\Status::RECEIVED->value => [
                                                'label' => __('global.order_received'),
                                                'color' => 'indigo-style',
                                            ],
                                            \App\Enums\Order\Status::COMPLETED->value => [
                                                'label' => __('global.completed'),
                                                'color' => 'success',
                                            ],
                                        ];

                                        $currentStatus = $order->status->value;
                                        $statusKeys = array_keys($steps);
                                        $currentIndex = array_search($currentStatus, $statusKeys);
                                        if ($currentIndex === false) {
                                            $currentIndex = 0;
                                        }
                                    @endphp

                                    @foreach ($steps as $statusValue => $stepData)
                                        @php
                                            $stepIndex = array_search($statusValue, $statusKeys);

                                            if ($stepIndex < $currentIndex) {
                                                $width = '100%';
                                                $barColor = 'bg-success';
                                                $isCurrent = false;
                                            } elseif ($stepIndex == $currentIndex) {
                                                $width = '60%';
                                                $barColor =
                                                    $stepData['color'] == 'indigo-style' ? '' : 'bg-' . $stepData['color'];
                                                $isCurrent = true;
                                            } else {
                                                $width = '0%';
                                                $barColor = 'bg-opacity-25 bg-secondary';
                                                $isCurrent = false;
                                            }
                                        @endphp

                                        <div class="col" style="flex: 1 0 0%;">
                                            <div class="progress mt-3" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped {{ $isCurrent ? 'progress-bar-animated' : '' }} {{ $barColor }}"
                                                    role="progressbar"
                                                    style="width: {{ $width }}; {{ $isCurrent && $stepData['color'] == 'indigo-style' ? 'background-color: #563d7c !important;' : '' }}"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center gap-2 mt-2">
                                                @php
                                                    $textStyle = '';
                                                    if ($isCurrent) {
                                                        if ($stepData['color'] == 'indigo-style') {
                                                            $textStyle = 'color: #563d7c !important;';
                                                        }
                                                    }
                                                @endphp
                                                <button type="button"
                                                    class="btn btn-link p-0 text-decoration-none text-dark fw-bold status-update-btn {{ $isCurrent && $stepData['color'] != 'indigo-style' ? 'text-' . $stepData['color'] : '' }}"
                                                    data-status="{{ $statusValue }}"
                                                    style="cursor: pointer; text-align: left; {{ $textStyle }} font-size: 13px; white-space: nowrap;">
                                                    {{ $stepData['label'] }}
                                                </button>

                                                @if ($isCurrent && $statusValue !== \App\Enums\Order\Status::COMPLETED->value)
                                                    <div class="spinner-border spinner-border-sm {{ $stepData['color'] == 'indigo-style' ? '' : 'text-' . $stepData['color'] }}"
                                                        role="status"
                                                        style="{{ $stepData['color'] == 'indigo-style' ? 'color: #563d7c !important;' : '' }}">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                        <div
                            class="card-footer d-flex flex-wrap align-items-center justify-content-between bg-light-subtle gap-2">
                            <p class="border rounded mb-0 px-2 py-1 bg-body"><i
                                    class='bx bx-arrow-from-left align-middle fs-16'></i>
                                {{ __('global.estimated_delivery_date') }} :
                                <span
                                    class="text-dark fw-medium">{{ $order->created_at->addDays(3)->translatedFormat('Y / m / D') }}</span>
                            </p>
                            {{-- <div>
                                <a href="#!" class="btn btn-info">
                                    {{ __('global.transaction_history') }}
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                {{ __('global.order_details') }} / {{ __('global.products') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle border-bottom">
                                        <tr>
                                            <th>
                                                {{ __('global.product') }}
                                            </th>
                                            <th>
                                                {{ __('global.price') }}
                                            </th>
                                            <th>
                                                {{ __('global.quantity') }}
                                            </th>
                                            <th>
                                                {{ __('global.subtotal') }}
                                            </th>
                                            <th>
                                                {{ __('global.status') }}
                                            </th>
                                            <th>
                                                {{ __('global.action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div
                                                            class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                            <img src="{{ $item->product->getFirstMediaUrl('images', 'thumb') }}"
                                                                alt="{{ $item->product->currentTranslation->name }}"
                                                                class="avatar-md">
                                                        </div>
                                                        <div>
                                                            <a href="#!" class="text-primary fw-medium fs-15 ">
                                                                {{ $item->product->currentTranslation->name }}
                                                            </a>
                                                            @foreach ($item->attributes as $key => $attribute)
                                                                <p class="text-muted mb-0 mt-1 fs-13">
                                                                    <span class="fw-bold text-dark">
                                                                        {{ __('global.'.$key )}} :
                                                                    </span>
                                                                    @if($key == 'color')
                                                                        <span class="d-inline-block rounded-circle border"
                                                                                style="width:18px;height:18px;background-color: {{ $attribute }};">
                                                                        </span>
                                                                        @else
                                                                        {{ $attribute }}
                                                                    @endif
                                                                </p>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                </td>

                                                <td>
                                                    {{ format_currency($item->price, 'EGP') }}
                                                </td>
                                                <td>
                                                    {{ $item->quantity }}
                                                </td>
                                                <td>
                                                    {{ format_currency($item->total, 'EGP') }}
                                                </td>
                                                <td>
                                                    @switch($item->status?->value)
                                                        @case('processing')
                                                            <span
                                                                class="badge border border-warning text-warning px-2 py-1 fs-13">
                                                                {{ __('global.processing') }}
                                                            </span>
                                                        @break

                                                        @case('shipped')
                                                            <span
                                                                class="badge border border-primary text-primary px-2 py-1 fs-13">
                                                                {{ __('global.shipped') }}
                                                            </span>
                                                        @break

                                                        @case('delivering')
                                                            <span class="badge border border-info text-info px-2 py-1 fs-13">
                                                                {{ __('global.delivered') }}
                                                            </span>
                                                        @break

                                                        @case('received')
                                                            <span class="badge border px-2 py-1 fs-13"
                                                                style="color: #ff6c2f !important; border-color: #ff6c2f !important;">
                                                                {{ __('global.order_received') }}
                                                            </span>
                                                        @break

                                                        @case('completed')
                                                            <span
                                                                class="badge border border-success text-success px-2 py-1 fs-13">
                                                                {{ __('global.completed') }}
                                                            </span>
                                                        @break

                                                        @case('cancelled')
                                                            <span
                                                                class="badge border border-danger text-danger px-2 py-1 fs-13">
                                                                {{ __('global.cancelled') }}
                                                            </span>
                                                        @break

                                                        @default
                                                            <span
                                                                class="badge border border-secondary text-secondary px-2 py-1 fs-13">
                                                                {{ __('global.pending') }}
                                                            </span>
                                                    @endswitch

                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-soft-danger btn-sm open-delete-modal"
                                                        data-url=""
                                                        data-name="{{ $item->product->currentTranslation->name }}">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                            class="align-middle fs-18"></iconify-icon>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                {{ __('global.order_timeline') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="position-relative ms-2">
                                <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                                @forelse ($order->activities as $activity)
                                    <div class="position-relative ps-4">
                                        <div class="mb-4">
                                            <span
                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                <i class='bx bx-check-circle'></i>
                                            </span>
                                            <div
                                                class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-1 text-dark fw-medium fs-15">
                                                        {{ $activity->title }}
                                                    </h5>
                                                    <p class="mb-2">
                                                        {{ $activity->description }}
                                                    </p>
                                                    @if ($activity->user)
                                                        <p class="mb-2">
                                                            <a href="" class="link-primary fw-medium">
                                                                {{ $activity->user->profile->first_name . ' ' . $activity->user->profile->last_name }}
                                                            </a>
                                                        </p>
                                                    @endif

                                                    @switch($activity->status?->value)
                                                        @case('processing')
                                                            <span
                                                                class="badge border border-warning text-warning px-2 py-1 fs-13">
                                                                {{ __('enum.processing') }}
                                                            </span>
                                                        @break

                                                        @case('shipped')
                                                            <span
                                                                class="badge border border-primary text-primary px-2 py-1 fs-13">
                                                                {{ __('enum.shipped') }}
                                                            </span>
                                                        @break

                                                        @case('delivering')
                                                            <span class="badge border border-info text-info px-2 py-1 fs-13">
                                                                {{ __('enum.delivered') }}
                                                            </span>
                                                        @break

                                                        @case('received')
                                                            <span class="badge border px-2 py-1 fs-13"
                                                                style="color: #ff6c2f !important; border-color: #ff6c2f !important;">
                                                                {{ __('enum.received') }}
                                                            </span>
                                                        @break

                                                        @case('completed')
                                                            <span
                                                                class="badge border border-success text-success px-2 py-1 fs-13">
                                                                {{ __('enum.completed') }}
                                                            </span>
                                                        @break

                                                        @case('cancelled')
                                                            <span
                                                                class="badge border border-danger text-danger px-2 py-1 fs-13">
                                                                {{ __('enum.cancelled') }}
                                                            </span>
                                                        @break

                                                        @default
                                                            <span
                                                                class="badge border border-secondary text-secondary px-2 py-1 fs-13">
                                                                {{ __('enum.pending') }}
                                                            </span>
                                                    @endswitch
                                                </div>
                                                <p class="mb-0">
                                                    {{ $activity->created_at->translatedFormat('F j, Y, h:i a') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @empty
                                        <div class="card p-5 text-center border-0 shadow-sm">
                                            <div class="d-flex flex-column align-items-center justify-content-center">
                                                <div class="bg-light-subtle rounded-circle d-flex align-items-center justify-content-center mb-3"
                                                    style="width: 80px; height: 80px;">
                                                    <iconify-icon icon="solar:folder-empty-broken" class="text-muted"
                                                        style="font-size: 45px;"></iconify-icon>
                                                </div>
                                                <h5 class="text-dark fw-semibold mb-1">{{ __('global.no_data_found') }}
                                                </h5>
                                                <p class="text-muted mb-0 fs-13">
                                                    {{ __('global.no_records_have_been_added_to_this_table_yet') }}</p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{ __('global.order_summary') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1">
                                                <iconify-icon icon="solar:clipboard-text-broken"></iconify-icon>
                                                {{ __('global.subtotal') }} :
                                            </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            {{ format_currency($order->subtotal, 'EGP') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex text-red mb-0 align-items-center gap-1"><iconify-icon
                                                    icon="solar:ticket-broken" class="align-middle"> </iconify-icon>
                                                {{ __('global.discount_total') }} :
                                            </p>
                                        </td>
                                        <td class="text-end text-red fw-medium px-0">
                                            -{{ format_currency($order->discount_total, 'EGP') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1">
                                                <iconify-icon icon="solar:kick-scooter-broken"
                                                    class="align-middle"></iconify-icon>
                                                {{ __('global.shipping_total') }} :
                                            </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            {{ format_currency($order->shipping_total, 'EGP') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <p class="d-flex mb-0 align-items-center gap-1">
                                                <iconify-icon icon="solar:calculator-minimalistic-broken"
                                                    class="align-middle"></iconify-icon>
                                                {{ __('global.tax_total') }} ({{config('app_settings.tax_percentage')}}%) :
                                            </p>
                                        </td>
                                        <td class="text-end text-dark fw-medium px-0">
                                            {{ format_currency($order->tax_total, 'EGP') }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                        <div>
                            <p class="fw-medium text-dark mb-0">
                                {{ __('global.grand_total') }}
                            </p>
                        </div>
                        <div>
                            <p class="fw-medium text-dark mb-0">
                                {{ format_currency($order->grand_total, 'EGP') }}
                            </p>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{ __('global.customer_information') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $order->user->getFirstMediaUrl('avatar') }}" loading="lazy"
                                alt="{{ $order->user->profile->first_name . ' ' . $order->user->profile->last_name }}"
                                class="avatar rounded-3 border border-light border-3">
                            <div>
                                <p class="mb-1">
                                    {{ $order->user->profile->first_name . ' ' . $order->user->profile->last_name }}
                                </p>
                                <a href="#!" class="link-primary fw-medium">
                                    {{ $order->user->email }}
                                </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">
                                {{ __('global.phone') }}
                            </h5>

                        </div>
                        <p class="mb-1">
                            {{ $order->user->phone }}
                        </p>

                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">
                                {{ __('global.shipping_address') }}
                            </h5>

                        </div>

                        <div>
                            <p class="mb-1">
                                {{ $order->address->name }}
                            </p>
                            <p class="mb-1">{{ $order->address->street_details }}</p>

                            <p class="mb-1">
                                {{ $order->address->city }} , {{ $order->address->country }}
                            </p>
                            <p class="mb-1"> {{ $order->address->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">

                    <div class="modal-body text-center p-4">

                        <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3"
                            style="width: 64px; height: 64px;">
                            <iconify-icon icon="solar:danger-triangle-bold-duotone"
                                style="font-size: 36px;"></iconify-icon>
                        </div>

                        <h4 class="text-dark fw-bold mb-2">{{ __('global.delete_confirmation') }}</h4>

                        <p class="text-muted fs-15 mb-3">
                            {{ __('global.delete_warning_title', ['name' => __('dashboard.item')]) }}
                            <strong id="name-span" class="text-dark fw-semibold d-block mt-1 fs-16"></strong>
                        </p>

                        <div class="alert alert-danger border-0 d-flex align-items-start text-start gap-2 mb-3 py-2 px-3 fs-13"
                            role="alert">
                            <iconify-icon icon="solar:info-circle-bold"
                                class="fs-18 mt-0.5 flex-shrink-0"></iconify-icon>
                            <div>
                                <strong>{{ __('global.delete_cascade_warning') }}</strong>
                            </div>
                        </div>

                        <p class="text-secondary small mb-0 fs-12">
                            <iconify-icon icon="solar:lock-password-broken" class="align-middle me-1"></iconify-icon>
                            {{ __('global.cannot_undo') }}
                        </p>
                    </div>

                    <div class="modal-footer border-0 bg-light-subtle d-flex justify-content-center gap-2 pb-4 pt-0 px-4">
                        <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal"
                            style="border-radius: 8px;">
                            {{ __('global.cancel') }}
                        </button>

                        <form id="modal-delete-form" action="" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger fw-medium px-4" style="border-radius: 8px;">
                                {{ __('global.confirm_delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @push('javascript')
            <script src="{{ asset('assets/js/dashboard/pages/order/order.js') }}"></script>
            <script src="{{ asset('assets/js/dashboard/pages/jquery/order/order.js') }}"></script>
        @endpush
    </x-dashboard.layout>