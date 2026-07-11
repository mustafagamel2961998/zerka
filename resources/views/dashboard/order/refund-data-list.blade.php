@php
    use App\Enums\Refund\RefundStatus;
@endphp
<div class="table-responsive">
    <table id="refund-request-table" class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <th>{{__('global.order_number')}}</th>
                <th>{{__('global.customer')}}</th>
                <th>{{ __('global.image') }}</th>
                <th>{{__('global.product')}}</th>
                <th>{{__('global.quantity')}}</th>
                <th>{{__('global.reason')}}</th>
                <th>{{__('global.created_at')}}</th>
                <th>{{ __('global.status') }}</th>
                <th class="text-center">{{ __('global.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($refunds as $refund)
                <tr>
                    <td>

                        <a href="{{ route('dashboard.v1.orders.show', $refund->order_id) }}" class="link-primary fw-medium">
                            
                            #{{ $refund->order->order_number }}
                        </a>
                    </td>

                    <td>
                        <a href="#!" class="link-primary fw-medium">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle" width="32"
                                     src="{{ $refund->order->user->getFirstMediaUrl('avatar') }}"
                                     loading="lazy"
                                     alt="{{ $refund->order->user->profile->full_name}}">
                                <span class="ms-2">
                                    {{ $refund->order->user->profile->full_name }}
                                </span>
                            </span>
                        </a>
                    </td>
                    <td>
                        <x-dashboard.partial.image :src="$refund->item->product->getFirstMediaUrl('images', 'thumb')" :class="'table-image cursor-pointer'" :alt="$refund->item->product->currentTranslation->name"/>
                    </td>

                    <td>
                        
                        <a href="#!" class="text-primary fw-medium fs-15 ">
                               {{ $refund->item->product->currentTranslation->name }}
                        </a>
                        @foreach ($refund->item->attributes as $key => $attribute)
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
                    </td>

                    <td>
                        {{ $refund->quantity }}
                    </td>

                    <td>
                        <span class="d-inline-block text-truncate" style="max-width: 180px;" title="{{ $refund->reason }}">
                            {{ $refund->reason ?: '-' }}
                        </span>
                    </td>

                    <td>
                        @php
                            $refundTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $refund->created_at->toDateTimeString(), config('app_settings.timezone'));
                        @endphp
                        {{ $refundTime->translatedFormat('Y-m-d') }} /
                        <small class="text-muted">({{ $refundTime->diffForHumans() }})</small>
                    </td>

                    <td>
                        @switch($refund->status?->value)
                            @case('approved')
                                <span class="badge border border-success text-success px-2 py-1 fs-13">
                                    {{ __('global.approved') }}
                                </span>
                                @break
                            @case('rejected')
                                <span class="badge border border-danger text-danger px-2 py-1 fs-13">
                                    {{ __('global.rejected') }}
                                </span>
                                @break
                            @default
                                <span class="badge border px-2 py-1 fs-13" style="color: #d63384 !important; border-color: #d63384 !important;">
                                    <iconify-icon icon="solar:clock-circle-broken" class="align-middle me-1"></iconify-icon>
                                    {{ __('global.pending') }}
                                </span>
                        @endswitch
                    </td>

                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ route('dashboard.v1.orders.show', $refund->order_id) }}" class="btn btn-light btn-sm" title="{{ __('global.view') }}">
                                <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                            </a>

                          @if($refund->status === RefundStatus::PENDING)
                            <div class="d-flex gap-2 justify-content-center">

                                {{-- Approve form --}}
                                <form action="{{ route('dashboard.v1.refund.update', $refund->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{RefundStatus::APPROVED->value }}">
                                    <button type="submit" class="btn btn-soft-success btn-sm" title="{{ __('global.approve_refund') }}">
                                        <iconify-icon icon="solar:check-circle-broken" class="align-middle fs-18"></iconify-icon>
                                    </button>
                                </form>

                                {{-- Reject button -> opens modal --}}
                                <button type="button"
                                    class="btn btn-soft-danger btn-sm reject-refund-btn"
                                    data-id="{{ $refund->id }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#rejectRefundModal"
                                    title="{{ __('global.reject_refund') }}">
                                    <iconify-icon icon="solar:close-circle-broken" class="align-middle fs-18"></iconify-icon>
                                </button>
                            </div>
                        @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="rejectRefundModal" tabindex="-1" aria-labelledby="rejectRefundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">

            <form id="reject-refund-form" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="{{ \App\Enums\Refund\RefundStatus::REJECTED->value }}">

                <div class="modal-body p-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3"
                        style="width: 56px; height: 56px;">
                        <iconify-icon icon="solar:close-circle-broken" style="font-size: 30px;"></iconify-icon>
                    </div>
                    <h5 class="text-dark fw-bold mb-2">{{ __('global.reject_refund') }}</h5>
                    <p class="text-muted fs-14 mb-3">{{ __('global.reject_refund_desc') }}</p>

                    <textarea name="reject_reason" class="form-control" rows="3"
                        placeholder="{{ __('global.reject_reason_placeholder') }}" required></textarea>
                </div>

                <div class="modal-footer border-0 bg-light-subtle d-flex justify-content-center gap-2 pb-4 pt-0 px-4">
                    <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                        {{ __('global.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger fw-medium px-4" style="border-radius: 8px;">
                        {{ __('global.confirm') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>