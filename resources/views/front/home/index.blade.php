<x-front.layout title="{{ __('front.home') }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/home/home.css') }}">
    @endpush
    <!-- 3. Features Bar -->
    <section class="py-4 border-bottom border-light-subtle mb-5">
        <div class="row g-4 text-center text-md-start">
            <div class="col-sm-6 col-md-3 d-md-flex align-items-center gap-3">
                <i class="bi bi-patch-check fs-2 text-dark mb-2 mb-md-0"></i>
                <div>
                    <h6 class="fw-bold m-0 text-uppercase small" style="letter-spacing: 0.5px;">
                       {{__('global.features.quality_title')}}
                    </h6>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">
                        {{__('global.features.quality_desc')}}
                    </small>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 d-md-flex align-items-center gap-3">
                <i class="bi bi-truck fs-2 text-dark mb-2 mb-md-0"></i>
                <div>
                    <h6 class="fw-bold m-0 text-uppercase small" style="letter-spacing: 0.5px;">
                        {{__('global.features.delivery_title')}}
                    </h6>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">
                        {{__('global.features.delivery_desc')}}
                    </small>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 d-md-flex align-items-center gap-3">
                <i class="bi bi-shield-lock fs-2 text-dark mb-2 mb-md-0"></i>
                <div>
                    <h6 class="fw-bold m-0 text-uppercase small" style="letter-spacing: 0.5px;">
                        {{__('global.features.payment_title')}}
                    </h6>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">
                        {{__('global.features.payment_desc')}}
                    </small>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 d-md-flex align-items-center gap-3">
                <i class="bi bi-headset fs-2 text-dark mb-2 mb-md-0"></i>
                <div>
                    <h6 class="fw-bold m-0 text-uppercase small" style="letter-spacing: 0.5px;">
                        {{__('global.features.support_title')}}
                    </h6>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">
                       {{__('global.features.support_desc')}}
                    </small>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Promo Banners Grid -->
    <section class="mb-5" id="collections">
        <div class="row g-0">
            <!-- Banner 1 -->
            @forelse ($categories as $category)
                <div class="col-md-4 position-relative overflow-hidden bg-dark text-white d-flex align-items-end category-banner"
                    style="background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.8)), url({{ $category->getFirstMediaUrl('cover', 'optimized') }}) center/cover no-repeat;">
                    <div class="p-4 w-100">
                        <span class="text-white-50 small text-uppercase"
                            style="font-size: 0.65rem; letter-spacing: 1px;">
                            {{ $category->currentTranslation->meta_title }}
                        </span>
                        <h5 class="fw-bold text-uppercase m-0 tracking-wide fs-6">
                            {{ $category->currentTranslation->name }}
                        </h5>
                        <a href="#" class="text-white small text-uppercase text-decoration-none d-block mt-2"
                            style="font-size: 0.7rem; font-weight: 600;">
                            {{ __('front.explore_now') }}
                            <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 mx-auto rounded-4" style="background-color: #f8f9fa; max-width: 500px;">
                        <div class="mb-3">
                            <i class="bi bi-bag-x text-muted" style="font-size: 3.5rem;"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">
                            {{ __('front.no_categories_found') }}
                        </h5>
                        <p class="text-muted small mb-4">
                            {{ __('front.no_categories_found_desc') }}
                        </p>

                    </div>
                </div>
            @endforelse

        </div>
    </section>

    <!-- 5. First Products -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-uppercase tracking-wider m-0" style="font-size: 0.95rem;">
                {{ __('global.products') }}
            </h6>
            <a href="#" class="text-dark small text-uppercase fw-semibold text-decoration-none"
                style="font-size: 0.75rem;">
                {{ __('global.view_all') }}
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3">

            @forelse ($first_products as $product)
                <!-- Product 1 -->
                <div class="col-6 col-md-3">
                    <div class="product-card">
                        <div class="position-relative p-3 text-center">
                            <button
                                class="btn btn-sm position-absolute top-0 end-0 m-2 p-0 text-dark border-0 bg-transparent">
                                <i class="bi bi-heart fs-5"></i>
                            </button>
                            <a href="{{route('products.show',['id'=>$product->id,'slug'=>$product->slug])}}">
                            <img src="{{ $product->getFirstMediaUrl('images', 'optimized') }}" loading="lazy"
                                class="img-fluid mix-blend-multiply product-img"
                                alt="{{ $product->currentTranslation->name }}">
                            </a>
                        </div>
                        <div class="mt-2 text-start product-footer">
                            <p class="m-0 text-muted text-uppercase fs-6">
                                <a href="{{route('products.show',['id'=>$product->id,'slug'=>$product->slug])}}" class="text-muted text-decoration-none">
                                    {{ $product->currentTranslation->name }}
                                </a>
                            </p>
                            <span class="fw-bold small" style="font-size: 0.8rem;">
                                {{ format_currency($product->minVariantPrice->price, current_currency_code()) }}
                            </span>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 mx-auto rounded-4" style="background-color: #f8f9fa; max-width: 500px;">
                        <div class="mb-3">
                            <i class="bi bi-bag-x text-muted" style="font-size: 3.5rem;"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">
                            {{ __('front.no_products_found') }}
                        </h5>
                        <p class="text-muted small mb-4">
                            {{ __('front.no_products_found_desc') }}
                        </p>

                    </div>
                </div>
            @endforelse


        </div>
    </section>

    <!-- 6. New Arrivals -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-uppercase tracking-wider m-0" style="font-size: 0.95rem;">
                {{ __('global.new_arrivals') }}
            </h6>
            <a href="#" class="text-dark small text-uppercase fw-semibold text-decoration-none"
                style="font-size: 0.75rem;">
                {{ __('global.view_all') }}
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-3">

            @forelse ($new_arrivals as $product)
                <!-- Product 1 -->
                <div class="col-6 col-md-3">
                    <div class="product-card">
                        <div class="position-relative p-3 text-center">
                            <button
                                class="btn btn-sm position-absolute top-0 end-0 m-2 p-0 text-dark border-0 bg-transparent">
                                <i class="bi bi-heart fs-5"></i>
                            </button>
                             <a href="{{route('products.show',['id'=>$product->id,'slug'=>$product->slug])}}">
                                <img src="{{ $product->getFirstMediaUrl('images', 'optimized') }}" loading="lazy"
                                    class="img-fluid mix-blend-multiply product-img"
                                    alt="{{ $product->currentTranslation->name }}">
                             </a>
                        </div>
                        <div class="mt-2 text-start product-footer">
                            <a href="{{route('products.show',['id'=>$product->id,'slug'=>$product->slug])}}" class="text-muted text-decoration-none">
                                <p class="m-0 text-muted text-uppercase">{{ $product->currentTranslation->name }}</p>
                             </a>
                            <span class="fw-bold small" style="font-size: 0.8rem;">
                                {{ format_currency($product->minVariantPrice->price, current_currency_code()) }}
                                
                            </span>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 mx-auto rounded-4" style="background-color: #f8f9fa; max-width: 500px;">
                        <div class="mb-3">
                            <i class="bi bi-bag-x text-muted" style="font-size: 3.5rem;"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">
                            {{ __('front.no_products_found') }}
                        </h5>
                        <p class="text-muted small mb-4">
                            {{ __('front.no_products_found_desc') }}
                        </p>

                    </div>
                </div>
            @endforelse


        </div>
    </section>


    <!-- 7. Stay In The Loop (Newsletter) -->
    <section class="bg-black text-white p-4 mb-5">
        <div class="row align-items-center py-2">
            <div class="col-md-6 mb-3 mb-md-0">
                <h6 class="text-uppercase fw-bold m-0 tracking-wider" style="font-size: 0.9rem;">
                    {{ __('global.newsletter.title')}}
                </h6>
                <p class="text-white-50 m-0 small" style="font-size: 0.75rem;">
                    {{__('global.newsletter.desc')}}
                </p>
            </div>
            <div class="col-md-6">
          <form class="d-flex bg-dark p-1 border border-secondary">
                <input type="email" name="email"
                    class="form-control form-control-sm bg-transparent border-0 text-white rounded-0 px-3 subscribe-email-input"
                    placeholder="{{__('global.newsletter.placeholder')}}" required style="box-shadow: none;">
                <button type="submit"
                    class="btn btn-light btn-sm text-uppercase fw-bold rounded-0 px-5 text-nowrap">
                {{__('global.newsletter.button')}}
                </button>
            </form>
            </div>
        </div>
    </section>

</x-front.layout>
