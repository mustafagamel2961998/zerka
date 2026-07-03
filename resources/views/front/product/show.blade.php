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
                            <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600" class="img-fluid border p-1 active thumbnail-trigger" alt="thumb 1">
                            <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?q=80&w=600" class="img-fluid border p-1 thumbnail-trigger" alt="thumb 2">
                            <img src="https://images.unsplash.com/photo-1554412933-514a83d2f3c8?q=80&w=600" class="img-fluid border p-1 thumbnail-trigger" alt="thumb 3">
                            <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?q=80&w=600" class="img-fluid border p-1 thumbnail-trigger" alt="thumb 4">
                            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=600" class="img-fluid border p-1 thumbnail-trigger" alt="thumb 5">
                        </div>
                    </div>
                    
                    <div class="col-lg-10">
                        <div class="position-relative bg-light border mb-2">
                            <button class="btn btn-sm position-absolute top-0 end-0 m-3 p-0 text-dark border-0 bg-transparent" style="z-index: 10;">
                                <i class="bi bi-heart fs-4"></i>
                            </button>
                            <img id="mainProductImage" src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=600" class="img-fluid main-preview-img" alt="Main Product">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-between">
                <div>
                    <h3 class="fw-bold text-uppercase tracking-wide mb-2 fs-4">{{ $product->currentTranslation->name }}</h3>
                    
                    <div class="mb-3">
                        <span class="fw-bold fs-5 text-dark">EGP 1,250.00</span>
                        <span class="text-muted text-decoration-line-through small ms-2">EGP 1,800.00</span>
                    </div>
                    
                    <hr class="text-light-subtle">

                    <p class="text-muted small lh-base mb-4">
                        سويت شيرت قطني مريح للغاية ومثالي للاستخدام اليومي. يتميز بخامات ثقيلة ومقاومة للانكماش مع قصة عصرية تناسب جميع الأذواق ومصنوع بالكامل في مصر بجودة عالمية.
                    </p>

                    <div class="mb-4 size-selector">
                        <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">Select Size</h6>
                        <div class="d-flex gap-2 flex-wrap">
                            <div>
                                <input type="radio" name="product_size" id="size_s" value="S" class="size-radio-input">
                                <label for="size_s" class="btn btn-outline-secondary rounded-0 size-badge px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">S</label>
                            </div>
                            <div>
                                <input type="radio" name="product_size" id="size_m" value="M" class="size-radio-input">
                                <label for="size_m" class="btn btn-outline-secondary rounded-0 size-badge px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">M</label>
                            </div>
                            <div>
                                <input type="radio" name="product_size" id="size_l" value="L" class="size-radio-input">
                                <label for="size_l" class="btn btn-outline-secondary rounded-0 size-badge px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">L</label>
                            </div>
                            <div>
                                <input type="radio" name="product_size" id="size_xl" value="XL" class="size-radio-input">
                                <label for="size_xl" class="btn btn-outline-secondary rounded-0 size-badge px-2.5 py-1.5 fw-semibold" style="font-size: 0.75rem;">XL</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 color-selector d-none" id="colorSelectorContainer">
                        <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">Available Colors</h6>
                        <div class="d-flex gap-3 id-colors-list"></div>
                    </div>

                    <div class="auth-only-actions border p-3 bg-light-subtle mb-4">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-4">
                                <h6 class="fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">Quantity</h6>
                                <div class="input-group border">
                                    <button class="btn btn-link text-dark text-decoration-none px-3 py-1 btn-qty-minus" type="button"><i class="bi bi-dash"></i></button>
                                    <input type="number" id="productQuantity" class="form-control bg-transparent border-0 text-center fw-bold shadow-none p-0 form-control-sm" value="1" min="1" readonly>
                                    <button class="btn btn-link text-dark text-decoration-none px-3 py-1 btn-qty-plus" type="button"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-8 pt-md-4">
                                <button type="button" class="btn btn-black btn-dark w-100 rounded-0 text-uppercase fw-bold tracking-wider py-2">
                                    Add to Cart <i class="bi bi-bag-plus ms-2"></i>
                                </button>
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