 @php
     use App\Enums\Order\Status;
 @endphp
<div class="table-responsive">
    <table id="my-order-html-table" class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <th>{{__('global.order_number')}}</th>
                <th>{{__('global.customer')}}</th>
                <th>{{__('global.subtotal')}}</th>
                <th>{{__('global.discount_total')}}</th>
                <th>{{__('global.shipping_total')}}</th>
                <th>{{__('global.tax_total')}}</th>
                <th>{{__('global.grand_total')}}</th>
                <th>{{__('global.coupon_code')}}</th>
                <th>{{__('global.payment_status')}}</th>
                <th>{{__('global.created_at')}}</th>
                <th>{{ __('global.status') }}</th>
                <th>{{ __('global.action') }}</th>
            </tr> 
             
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <a href="#!" class="link-primary fw-medium">
                            #{{$order->order_number}}
                        </a>
                    </td>
                    <td>
                        
                        <a href="#!" class="link-primary fw-medium">
                            <span class="d-flex align-items-center">
                                <img class="rounded-circle" width="32" src="{{$order->user->getFirstMediaUrl('avatar')}}" loading="lazy" alt="{{$order->user->profile->first_name .' '.$order->user->profile->last_name}}">
                                {{$order->user->profile->first_name .' '.$order->user->profile->last_name}}
                            </span>
                        </a>
                    </td>
                    <td>
                        {{ format_currency($order->subtotal,'EGP') }}
                    </td>
                  
                    <td> 
                       {{ format_currency($order->discount_total,'EGP') }}
                    </td>
                    <td>
                        {{ format_currency($order->shipping_total,'EGP') }}

                    </td>
                    <td> 
                        {{ format_currency($order->tax_total,'EGP') }}
                    </td>
                    <td> 
                        {{ format_currency($order->grand_total,'EGP') }}
                    </td>
                    <td> 
                        {{$order->coupon_code ? $order->coupon_code : '-'}}
                    </td>
                    <td>
                       @switch($order->payment_status)
                           @case('paid')
                               <span class="badge  bg-success text-light px-2 py-1 fs-13">
                                {{__('global.paid')}}
                               </span>
                               @break
                            @case('failed')
                                <span class="badge  bg-danger text-light px-2 py-1 fs-13">
                                    {{__('global.failed')}}
                                </span>
                            @break
                           @default
                            <span class="badge  bg-warning text-light px-2 py-1 fs-13">
                                {{__('global.pending')}}
                            </span>   
                       @endswitch
                    </td>
                    <td> 
                       {{ $order->created_at->translatedFormat('Y-m-d') }} /
                        <small class="text-muted">({{ $order->created_at->diffForHumans() }})</small>
                    </td>
                    <td>
                         {{-- // pending, processing, shipped, delivered, cancelled --}}
                        @switch($order->status?->value)
                            @case('pending')
                                <span class="badge border border-secondary text-secondary px-2 py-1 fs-13">
                                    {{__('global.pending')}}
                                </span>
                                @break
                            @case('processing')
                                <span class="badge border border-warning text-warning px-2 py-1 fs-13">
                                    {{__('global.processing')}}
                                </span>
                                @break
                            @case('shipped')
                                <span class="badge border border-primary text-primary px-2 py-1 fs-13">
                                    {{__('global.shipped')}}
                                </span>
                                @break
                            @case('delivering')
                                <span class="badge border border-info text-info px-2 py-1 fs-13">
                                    {{__('global.delivered')}}
                                </span>
                                @break
                          @case('received')
                                <span class="badge border px-2 py-1 fs-13" style="color: #ff6c2f !important; border-color: #ff6c2f !important;">
                                    {{ __('global.order_received') }}
                                </span>
                            @break 
                            @case('completed')
                                <span class="badge border border-success text-success px-2 py-1 fs-13">
                                    {{__('global.completed')}}
                                </span>
                                @break            
                            @case('cancelled')
                                <span class="badge border border-danger text-danger px-2 py-1 fs-13">
                                    {{__('global.cancelled')}}
                                </span>
                                @break
                            @default
                                <span class="badge border border-dark text-dark px-2 py-1 fs-13">
                                    {{ $order->status?->value }}
                                </span>
                        @endswitch
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                                <a href="{{route('dashboard.v1.orders.show', $order->id)}}" class="btn btn-light btn-sm">
                                    <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                </a>
                            
                            <a href="{{route('dashboard.v1.orders.show', $order->id)}}" class="btn btn-soft-primary btn-sm">
                                <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                            </a>
                            @if ($order->status?->value === Status::PENDING->value)
                                <a href="#!" class="btn btn-soft-danger btn-sm">
                                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                </a>
                            @endif

                        </div>
                    </td>
                </tr>
            @endforeach
  
        </tbody>
    </table>
</div>


<div id="table-order-gridjs"></div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
aria-hidden="true">
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
                {{ __('global.delete_warning_title', ['name' => __('dashboard.color')]) }}
                <strong id="name-span" class="text-dark fw-semibold d-block mt-1 fs-16"></strong>
            </p>

            <p class="text-secondary small mb-0 fs-12">
                <iconify-icon icon="solar:lock-password-broken"
                    class="align-middle me-1"></iconify-icon>
                {{ __('global.cannot_undo') }}
            </p>
        </div>

        <div
            class="modal-footer border-0 bg-light-subtle d-flex justify-content-center gap-2 pb-4 pt-0 px-4">
            <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal"
                style="border-radius: 8px;">
                {{ __('global.cancel') }}
            </button>

            <form id="modal-delete-form" action="" method="POST" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger fw-medium px-4"
                    style="border-radius: 8px;">
                    {{ __('global.confirm_delete') }}
                </button>
            </form>
        </div>
    </div>
</div>
</div>
