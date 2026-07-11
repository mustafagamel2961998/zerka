<x-front.layout title="{{ __('front.order_details') }} #{{ $order->order_number }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/order/order.css') }}">
    @endpush

    <div class="container py-5">

        <div
            class="mb-5 border-bottom border-light-subtle pb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3 class="fw-bold text-uppercase tracking-wider fs-4 mb-1">
                    {{ __('front.order_details') }}
                </h3>
                <p class="text-muted small mb-0">
                    #{{ $order->order_number }} —
                    {{ $order->created_at->translatedFormat('Y-m-d') }}
                </p>
            </div>
            <a href="{{ route('profile.index') }}" class="btn btn-sm btn-outline-dark rounded-0 px-3">
                <i class="bi bi-arrow-left me-1"></i> {{ __('front.back_to_orders') }}
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success rounded-0 small">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger rounded-0 small">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive border rounded-0 bg-white">
            <table class="table table-borderless align-middle mb-0 small">
                <thead class="table-light border-bottom border-light-subtle">
                    <tr class="text-uppercase tracking-wide text-muted fw-bold" style="font-size: 0.65rem;">
                        <th class="py-3">{{ __('front.product') }}</th>
                        <th class="py-3 text-center">{{ __('front.quantity') }}</th>
                        <th class="py-3 text-center">{{ __('front.price') }}</th>
                        <th class="py-3 text-center">{{ __('front.total') }}</th>
                        <th class="py-3 text-center">{{ __('front.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr class="border-bottom border-light-subtle">
                            <td class="py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $item->product?->getFirstMediaUrl('images') }}" width="50"
                                        height="50" class="rounded-0 border" style="object-fit: cover;">
                                    <div>
                                        @foreach ($item->attributes as $key => $attribute)
                                            <p class="text-muted mb-0 mt-1 fs-13">
                                                <span class="fw-bold text-dark">
                                                    {{ __('global.' . $key) }} :
                                                </span>
                                                @if ($key == 'color')
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
                            <td class="text-center">
                                {{ $item->quantity }}

                            </td>
                            <td class="text-center">{{ format_currency($item->price, current_currency_code()) }}</td>
                            <td class="text-center fw-semibold">
                                {{ format_currency($item->total, current_currency_code()) }}</td>
                            <td class="text-center">
                                @php
                                    $latestRefund = $item->refunds->sortByDesc('created_at')->first();
                                @endphp

                                @if ($latestRefund)
                                    @switch($latestRefund->status)
                                        @case(\App\Enums\Refund\RefundStatus::PENDING)
                                            <span class="badge border px-2 py-1 rounded-0"
                                                style="color: #d63384 !important; border-color: #d63384 !important; font-size: 0.65rem;">
                                                <i class="bi bi-clock-history me-1"></i>
                                                {{ __('front.refund_pending') }}
                                            </span>
                                        @break

                                        @case(\App\Enums\Refund\RefundStatus::APPROVED)
                                            <span class="badge bg-success-subtle text-success rounded-0 px-2 py-1"
                                                style="font-size: 0.65rem;">
                                                <i class="bi bi-check-circle me-1"></i>
                                                {{ __('front.refund_approved') }}
                                            </span>
                                        @break

                                        @case(\App\Enums\Refund\RefundStatus::REJECTED)
                                            <span class="badge bg-danger-subtle text-danger rounded-0 px-2 py-1"
                                                style="font-size: 0.65rem; cursor: pointer;" data-bs-toggle="tooltip"
                                                title="{{ $latestRefund->reject_reason }}">
                                                <i class="bi bi-x-circle me-1"></i>
                                                {{ __('front.refund_rejected') }}
                                            </span>

                                            {{-- لو لسه فيه كمية متاحة يقدر يطلب استرجاع تاني بعد الرفض --}}
                                            @if ($item->refundable_quantity > 0 && in_array($order->status?->value, ['completed', 'received']))
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger rounded-0 px-2 mt-1 refund-btn"
                                                    data-bs-toggle="modal" data-bs-target="#refundModal"
                                                    data-item-id="{{ $item->id }}"
                                                    data-max-quantity="{{ $item->refundable_quantity }}"
                                                    data-product-name="{{ $item->product?->name }}">
                                                    <i class="bi bi-arrow-return-left me-1"></i>
                                                    {{ __('front.request_refund_again') }}
                                                </button>
                                            @endif
                                        @break
                                    @endswitch
                                @elseif($item->refundable_quantity > 0 && in_array($order->status?->value, ['completed', 'received']))
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger rounded-0 px-2 refund-btn"
                                        data-bs-toggle="modal" data-bs-target="#refundModal"
                                        data-item-id="{{ $item->id }}"
                                        data-max-quantity="{{ $item->refundable_quantity }}"
                                        data-product-name="{{ $item->product?->name }}">
                                        <i class="bi bi-arrow-return-left me-1"></i>
                                        {{ __('front.request_refund') }}
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <div class="text-end" style="min-width: 220px;">
                <div class="d-flex justify-content-between small mb-1">
                    <span class="text-muted">{{ __('front.grand_total') }}</span>
                    <span class="fw-bold">{{ format_currency($order->grand_total, current_currency_code()) }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Refund Request Modal --}}
    <div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 border-dark">
                <div class="modal-header border-bottom-0 py-3">
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                    <h5 class="modal-title fw-bold text-uppercase fs-6" id="refundModalLabel">
                        {{ __('front.request_refund') }}
                    </h5>
                </div>

                <form action="{{ route('refunds.store') }}" method="POST" id="refundForm">
                    @csrf
                    <input type="hidden" name="order_item_id" id="refund_item_id">

                    <div class="modal-body py-0">
                        <p class="small text-muted mb-3" id="refund-product-name"></p>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted" for="refund_quantity">
                                {{ __('front.quantity_to_refund') }}
                            </label>
                            <input type="number" class="form-control rounded-0 shadow-none form-control-sm"
                                id="refund_quantity" name="quantity" min="1" required>
                            <small class="text-muted" id="refund-max-hint"></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted" for="refund_reason">
                                {{ __('front.refund_reason') }}
                            </label>
                            <textarea class="form-control rounded-0 shadow-none small" rows="3" name="reason" id="refund_reason" required
                                placeholder="{{ __('front.refund_reason_placeholder') }}"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer border-top-0 pt-0 pb-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-0 px-3"
                            data-bs-dismiss="modal">{{ __('front.cancel') }}</button>
                        <button type="submit" class="btn btn-sm btn-dark rounded-0 px-4">
                            {{ __('front.submit_request') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            const refundMaxQuantityLabel = "{{ __('front.max_available') }}";
        </script>
        <script src="{{ asset('assets/js/front/pages/order/order.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {

                // Fill modal data on refund button click
                $(document).on('click', '.refund-btn', function() {
                    const itemId = $(this).data('item-id');
                    const maxQuantity = $(this).data('max-quantity');
                    const productName = $(this).data('product-name');

                    $('#refund_item_id').val(itemId);
                    $('#refund_quantity')
                        .attr('max', maxQuantity)
                        .val(1);
                    $('#refund-max-hint').text(`${refundMaxQuantityLabel}: ${maxQuantity}`);
                    $('#refund-product-name').text(productName);
                });

                // Client-side validation before submit (server-side validation موجود بالفعل كـ fallback)
                $('#refundForm').on('submit', function(e) {
                    const quantity = parseInt($('#refund_quantity').val());
                    const max = parseInt($('#refund_quantity').attr('max'));

                    if (quantity > max) {
                        e.preventDefault();
                        toastr.error(`${refundMaxQuantityLabel}: ${max}`);
                        return false;
                    }

                    if (quantity < 1) {
                        e.preventDefault();
                        toastr.error('الكمية غير صحيحة');
                        return false;
                    }
                });

            });
        </script>
    @endpush
</x-front.layout>
