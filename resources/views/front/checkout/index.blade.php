<x-front.layout title="{{ __('front.checkout') }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/checkout/checkout.css') }}">
    @endpush

    <div class="container py-5">
        <form action="{{route('checkout.store')}}" method="POST" enctype="multipart/form-data" id="checkoutForm">
            @csrf
            <div class="row g-5">

                <div class="col-lg-7">

                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-uppercase tracking-wider fs-6 mb-0">
                                <span class="text-muted me-2">01.</span>{{ __('front.shipping_address')}}
                            </h5>
                            <a href="{{route('profile.index')}}" >
                                <button type="button" class="btn btn-sm btn-outline-dark rounded-0 px-3 small">
                                    <i class="bi bi-plus-lg me-1"></i>
                                    {{ __('front.add_new_address')}}
                                </button>
                            </a>
                        </div>

                        <div class="row g-3">
                            @forelse ($addresses as $address)
                                <div class="col-md-6">
                                    <div class="border p-3 position-relative rounded-0 address-card bg-light-subtle">

                                        <input type="radio" name="address_id" id="address_{{$address->id}}" value="{{$address->id}}"
                                            class="position-absolute top-0 end-0 m-3 form-check-input shadow-none" checked>

                                        <label for="address_{{$address->id}}" class="w-100 cursor-pointer pe-5">
                                            <span class="d-block fw-bold small mb-1">({{__('front.name')}}) : {{$address->name}} </span>
                                            
                                            <span class="d-block text-muted small">                                                
                                                {{ $address->street_details }}
                                            </span>
                                            <span class="d-block text-muted small mt-2">
                                                {{ $address->city->currentTranslation->name }}
                                                ,
                                                {{ $address->country->currentTranslation->name }}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            @empty
                               <div class="col-12 text-center py-4">
                                    <div class="mb-3">
                                        <i class="bi bi-geo-alt text-muted fs-1 d-block mb-2"></i>
                                        <p class="text-muted small fw-bold">{{ __('front.no_addresses_found') }}</p>
                                    </div>
                                    <div>
                                        <a href="{{route('profile.index')}}">
                                            <button type="button" class="btn btn-sm btn-outline-dark rounded-0 px-3 small">
                                                <i class="bi bi-plus-lg me-1"></i>
                                                {{ __('front.add_new_address') }}
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                             
                            @error('address_id')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                            
                        </div>
                    </div>

                    <hr class="my-4 text-light-subtle">

                    <div class="mb-4">
                        <h5 class="fw-bold text-uppercase tracking-wider fs-6 mb-3">
                            <span class="text-muted me-2">02.</span>{{ __('front.payment_method')}}
                        </h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="border p-3 rounded-0 payment-option-wrapper bg-light-subtle">
                                <div class="form-check m-0">
                                    <input class="form-check-input shadow-none" type="radio" name="payment_method"
                                        id="pay_cod" value="cod" checked>
                                    <label class="form-check-label fw-semibold small ms-2 w-100 cursor-pointer"
                                        for="pay_cod">
                                        <i class="bi bi-cash-coin me-2"></i>
                                        {{ __('front.cod') }}
                                    </label>
                                </div>
                            </div>

                            <div class="border p-3 rounded-0 payment-option-wrapper">
                                <div class="form-check m-0">
                                    <input class="form-check-input shadow-none" type="radio" name="payment_method"
                                        id="pay_wallet" value="wallet">
                                    <label class="form-check-label fw-semibold small ms-2 w-100 cursor-pointer"
                                        for="pay_wallet">
                                        <i class="bi bi-wallet2 me-2"></i>
                                        {{ __('front.e_wallet') }}
                                    </label>
                                </div>

                                <div id="walletDetailsContainer"
                                    class="mt-3 p-3 bg-white border border-light-subtle d-none">
                                    <div class="alert alert-secondary rounded-0 small border-0 mb-3"
                                        style="background-color: #f8f9fa;">
                                        <i class="bi bi-info-circle me-2 text-dark"></i>
                                        {{ __('front.wallet_instruction')}}
                                        <div class="mt-2 fw-bold text-dark fs-6 text-center tracking-wider">
                                            {{ config('app_settings.phone') }}
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <label for="screenshotInput"
                                            class="form-label small fw-bold text-muted text-uppercase">{{ __('front.upload_receipt') }}</label>
                                        <input class="form-control rounded-0 form-control-sm shadow-none" type="file"
                                            id="screenshotInput" name="screen_shot" accept="image/*">
                                        <div class="form-text small text-muted" style="font-size: 0.65rem;">
                                            يقبل الملفات
                                            من نوع صور فقط (JPG, PNG).</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         @error('payment_method')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        @error('screen_shot')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="col-lg-5">
                    <div class="border p-4 bg-light-subtle rounded-0 position-sticky" style="top: 20px;">
                        <h5 class="fw-bold text-uppercase tracking-wider fs-6 mb-4">
                            {{ __('front.order_summary')}}</h5>

                        <div class="checkout-items-list mb-4" style="max-height: 240px; overflow-y: auto;">
                            @if ($cart && $cart->items->count() > 0)
                                @foreach ($cart->items as $item)
                                    <div class="d-flex align-items-center gap-3 py-2 border-bottom border-light-subtle">
                                        <img src="{{ $item->product->getFirstMediaUrl('images', 'thumb') }}"
                                            class="rounded border bg-white"
                                            style="width: 50px; height: 50px; object-fit: contain;" alt="Product">
                                        <div class="flex-grow-1">
                                            <h6 class="fw-semibold mb-1 fs-7 text-truncate" style="max-width: 200px;">
                                                {{ $item->product->name }}
                                            </h6>

                                            <div class="product-meta d-flex flex-column gap-1 text-muted"
                                                style="font-size: 0.7rem;">

                                                @if ($item->size)
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="text-uppercase fw-medium me-1">{{ __('front.size') }}:</span>
                                                        <span class="text-dark fw-semibold">{{ $item->size }}</span>
                                                    </div>
                                                @endif

                                                @if ($item->color)
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="text-uppercase fw-medium me-1">{{ __('front.color') }}:</span>
                                                        <span class="d-inline-block rounded-circle border"
                                                            style="width: 12px; height: 12px; background-color: {{ $item->color }};">
                                                        </span>
                                                    </div>
                                                @endif

                                                <div class="d-flex align-items-center mt-1">
                                                    <span
                                                        class="text-uppercase fw-medium text-muted me-1">{{ __('front.quantity') ?? 'Qty' }}:</span>
                                                    <span
                                                        class="badge bg-dark-subtle text-dark rounded-0 px-1.5 py-0.5 fw-bold"
                                                        style="font-size: 0.65rem;">
                                                        {{ $item->quantity }}
                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                        <span
                                            class="fw-semibold small ms-auto">{{ format_currency($item->total, current_currency_code()) }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="price-breakdown small border-bottom border-light-subtle pb-3 mb-3">
                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>{{ __('front.subtotal') }}</span>
                                <span>{{ format_currency($cart->subtotal ?? 0, current_currency_code()) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>{{ __('front.discount') }}</span>
                                <span>- {{ format_currency($cart->discount_total, current_currency_code()) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 text-muted">
                                <span>{{ __('front.tax') }}</span>
                                @php
                                    $taxPercentage = (float) config('app_settings.tax_percentage', 0);
                                    $tax = ($cart->subtotal * $taxPercentage) / 100;
                                @endphp
                                <span>{{ format_currency(number_format($tax, 2),current_currency_code()) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-0 text-muted">
                                <span>{{ __('front.shipping') }}</span>
                                <span>{{ format_currency(config('app_settings.shipping_amount'), current_currency_code()) }}</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="text-uppercase small fw-bold text-dark">{{ __('front.total')}}</span>
                            <span class="fw-bold fs-4 text-dark">
                                @php
                                    $grand_total = $tax + $cart->subtotal - $cart->discount_total + config('app_settings.shipping_amount');
                                @endphp
                                {{ format_currency($grand_total, current_currency_code()) }}
                            </span>
                        </div>

                        <button type="submit"
                            class="btn btn-black btn-dark w-100 rounded-0 text-uppercase fw-bold tracking-wider py-2.5 fs-7">
                            {{ __('front.place_order') }}
                            <i class="bi bi-shield-check ms-2"></i>
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

  

    @push('js')
        <script src="{{ asset('assets/js/front/pages/checkout/checkout.js') }}"></script>
    @endpush
</x-front.layout>
