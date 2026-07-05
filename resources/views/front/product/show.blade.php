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
                    @endauth
                </div>
            </div>

        </div>
    </div>

    @push('js')
        <script src="{{ asset('assets/js/front/pages/product/product.js') }}"></script>
    @endpush
</x-front.layout>