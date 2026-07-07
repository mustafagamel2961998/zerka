<x-front.layout title="{{ $product->currentTranslation->name }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/product/product.css') }}">
    @endpush

    <div class="container py-5">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="row g-2 flex-column-reverse flex-lg-row">
                    <div class="col-lg-2">
                        <div class="d-flex flex-row flex-lg-column gap-2 product-thumbnails">
                            @foreach ($product->getMedia('images') as $media)
                                 <img src="{{$media->getUrl('optimized')}}" class="img-fluid border p-1 @if($loop->first) active @endif thumbnail-trigger" alt="{{ $product->currentTranslation->name }}">
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-10">
                        <div class="position-relative bg-light border mb-2">
                            <button class="btn btn-sm position-absolute top-0 end-0 m-3 p-0 text-dark border-0 bg-transparent" style="z-index: 10;">
                                <i class="bi bi-heart fs-4"></i>
                            </button>
                            <img id="mainProductImage" src="{{ $product->getFirstMediaUrl('images', 'optimized') }}" class="img-fluid main-preview-img" alt="{{ $product->currentTranslation->name }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-between">
                <div>
                    <h3 class="fw-bold text-uppercase tracking-wide mb-2 fs-4">{{ $product->currentTranslation->name }}</h3>

                    <div class="mb-3">
                            <span class="fw-bold fs-5 text-dark" id="currentProductPrice">
                                {{ format_currency($product->variants->first()->price, current_currency_code()) }}
                            </span>
                    </div>
                    <hr class="text-light-subtle">

                    <p class="text-muted small lh-base mb-4">
                        {{$product->currentTranslation->description}}
                    </p>

                    <div class="mb-4 size-selector">
                        <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                            {{__('front.select_size')}}
                        </h6>
                        <div class="d-flex gap-2 flex-wrap">
                            @foreach ($product->variants as $variant)
                                @php
                                    // بيانات العرض بس (شكلية) — السيرفر مش هيثق في أي رقم منها
                                    $colorsData = $variant->colors->map(function ($variantColor) {
                                        return [
                                            'variant_color_id' => $variantColor->id,
                                            'code'             => $variantColor->color->code ?? '#000',
                                            'name'             => $variantColor->color->currentTranslation->name ?? ($variantColor->color->name ?? ''),
                                            'quantity'         => $variantColor->inventory->quantity ?? 0,
                                        ];
                                    });
                                @endphp
                                <div>
                                    <input type="radio"
                                        name="size"
                                        id="size_{{ $loop->index }}"
                                        value="{{ $variant->size->size }}"
                                        class="size-radio-input"
                                        data-variant-id="{{ $variant->id }}"
                                        data-currency="{{ getCurrencySymbol(current_currency_code()) }}"
                                        data-price="{{ $variant->price }}"
                                        data-colors="{{ $colorsData->toJson() }}"
                                        {{ $loop->first ? 'checked' : '' }}>
                                        <label for="size_{{ $loop->index }}" class="btn btn-outline-secondary rounded-0 size-badge px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">
                                            {{ $variant->size->size }}
                                        </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4 color-selector d-none" id="colorSelectorContainer">
                        <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                            {{__('front.select_color')}}
                        </h6>
                        <div class="d-flex gap-3 id-colors-list"></div>
                        <div class="small text-muted mt-2 d-none" id="stockStatusText"></div>
                    </div>
                    @auth
                     <div class="auth-only-actions border p-3 bg-light-subtle mb-4">
                            <div class="row g-2 align-items-center">
                                <div class="col-md-4">
                                    <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                                        {{__('front.quantity')}}
                                    </h6>
                                    <div class="input-group border">
                                        <button class="btn btn-link text-dark text-decoration-none px-3 py-1 btn-qty-minus" type="button">
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <input type="number" id="productQuantity" name="quantity" class="form-control bg-transparent border-0 text-center fw-bold shadow-none p-0 form-control-sm" value="1" min="1" readonly>
                                        <button class="btn btn-link text-dark text-decoration-none px-3 py-1 btn-qty-plus" type="button">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-8 pt-md-4">
                                    <button type="button" id="addToCartBtn" class="btn btn-black btn-dark w-100 rounded-0 text-uppercase fw-bold tracking-wider py-2">
                                    {{__('front.add_to_cart')}}
                                        <i class="bi bi-bag-plus ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- @if(!in_array($product->id,auth()->user()->cart->items->pluck('product_id')->toArray()))
                            <div class="auth-only-actions border p-3 bg-light-subtle mb-4">
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-4">
                                        <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                                            {{__('front.quantity')}}
                                        </h6>
                                        <div class="input-group border">
                                            <button class="btn btn-link text-dark text-decoration-none px-3 py-1 btn-qty-minus" type="button">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                            <input type="number" id="productQuantity" name="quantity" class="form-control bg-transparent border-0 text-center fw-bold shadow-none p-0 form-control-sm" value="1" min="1" readonly>
                                            <button class="btn btn-link text-dark text-decoration-none px-3 py-1 btn-qty-plus" type="button">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-8 pt-md-4">
                                        <button type="button" id="addToCartBtn" class="btn btn-black btn-dark w-100 rounded-0 text-uppercase fw-bold tracking-wider py-2">
                                        {{__('front.add_to_cart')}}
                                            <i class="bi bi-bag-plus ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="already-in-cart-notice border border-dark p-4 bg-white text-center mb-4 rounded-0">
                                <div class="mb-2 text-success">
                                    <i class="bi bi-check-circle-fill fs-4"></i>
                                </div>
                                <h6 class="fw-bold text-uppercase mb-1 fs-7" style="letter-spacing: 0.05em;">
                                    {{ __('front.already_in_cart')}}
                                </h6>
                                <p class="text-muted small mb-3">
                                    {{ __('front.already_in_cart_msg')}}
                                </p>
                                
                                <button type="button" class="btn btn-black btn-dark rounded-0 text-uppercase fw-bold tracking-wider py-2 px-4 fs-7 w-100" 
                                        data-bs-toggle="offcanvas" data-bs-target="#cartSidebar" aria-controls="cartSidebar">
                                    {{ __('front.view_cart')}}
                                    <i class="bi bi-bag-check ms-2"></i>
                                </button>
                            </div>
                        @endif --}}
                    @endauth
                    @guest
                        <div class="guest-cart-notice border border-light-subtle p-4 bg-light-subtle text-center mb-4 rounded-0">
                            <div class="mb-3">
                                <i class="bi bi-box-seam fs-3 text-muted"></i>
                            </div>
                            <h6 class="fw-bold text-uppercase mb-2 fs-7" style="letter-spacing: 0.05em;">
                                {{ __('front.ready_to_shop')}}
                            </h6>
                            <p class="text-muted small mb-3 px-3">
                                {{ __('front.login_to_add_to_cart_msg')}}
                            </p>
                            <a href="{{ route('login') }}" class="btn btn-black btn-dark rounded-0 text-uppercase fw-bold tracking-wider py-2 px-4 fs-7">
                                {{ __('front.login_now')}}
                                <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    @endguest
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-10 mx-auto">

                    <div class="accordion accordion-flush border-top" id="productInfoAccordion">

                        <div class="accordion-item border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-0 bg-transparent fw-bold text-uppercase py-3 px-0"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDetails" aria-expanded="false">
                                    {{ __('front.product_details') }}
                                </button>
                            </h2>
                            <div id="collapseDetails" class="accordion-collapse collapse"
                                data-bs-parent="#productInfoAccordion">
                                <div class="accordion-body px-0 pb-4 text-muted small lh-lg">
                                    {!! nl2br(e($product->currentTranslation->long_description)) !!}
                                </div>
                            </div>
                        </div>

                        {{-- الشحن والاسترجاع --}}
                        <div class="accordion-item border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed rounded-0 bg-transparent fw-bold text-uppercase py-3 px-0"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseShipping" aria-expanded="false">
                                    {{ __('front.shipping_returns') }}
                                </button>
                            </h2>
                            <div id="collapseShipping" class="accordion-collapse collapse"
                                data-bs-parent="#productInfoAccordion">
                                <div class="accordion-body px-0 pb-4 text-muted small lh-lg">
                                    {{ __('front.shipping_returns_text') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('assets/js/front/pages/product/product.js') }}"></script>
    @endpush
</x-front.layout>