<x-front.layout title="{{ $category->currentTranslation->name }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/category/category.css') }}">
    @endpush

    <div class="container py-5">

        <!-- Breadcrumb / Header -->
        <div class="mb-4 border-bottom border-light-subtle pb-3 d-flex justify-content-between align-items-end flex-wrap gap-2">
            <div>
                <p class="text-muted small mb-1">
                    <a href="{{ route('home') }}" class="text-muted text-decoration-none">{{ __('front.home') }}</a>
                    / <span class="text-dark">{{ $category->currentTranslation->name }}</span>
                </p>
                <h3 class="fw-bold text-uppercase tracking-wider fs-4 mb-0">
                    {{ $category->currentTranslation->name }}
                </h3>
            </div>
            <span class="text-muted small">
                {{ __('front.results_count', ['count' => $products->total()]) }}
            </span>
        </div>

        <div class="row g-4">

            <!-- Sidebar Filters -->
            <div class="col-lg-3">
            <form id="filterForm" method="GET" action="{{ route('categories.products', ['id' => $category->id, 'slug' => $category->slug]) }}">

                    <div class="border rounded-0 p-3 mb-3 bg-light-subtle">
                        <h6 class="fw-bold text-uppercase small mb-3" style="letter-spacing: 0.5px;">
                            {{ __('front.filter_by_price') }}
                        </h6>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number" name="min_price" min="0"
                                    class="form-control form-control-sm rounded-0 shadow-none"
                                    placeholder="{{ __('front.min') }}"
                                    value="{{ request('min_price') }}">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" min="0"
                                    class="form-control form-control-sm rounded-0 shadow-none"
                                    placeholder="{{ __('front.max') }}"
                                    value="{{ request('max_price') }}">
                            </div>
                        </div>
                    </div>

                    @if($sizes->isNotEmpty())
                        <div class="border rounded-0 p-3 mb-3 bg-light-subtle">
                            <h6 class="fw-bold text-uppercase small mb-3" style="letter-spacing: 0.5px;">
                                {{ __('front.filter_by_size') }}
                            </h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($sizes as $size)
                                    <label class="size-filter-label">
                                        <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
                                            class="d-none size-filter-input"
                                            {{ in_array($size->id, request('sizes', [])) ? 'checked' : '' }}>
                                        <span class="size-filter-box">{{ $size->size }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($colors->isNotEmpty())
                        <div class="border rounded-0 p-3 mb-3 bg-light-subtle">
                            <h6 class="fw-bold text-uppercase small mb-3" style="letter-spacing: 0.5px;">
                                {{ __('front.filter_by_color') }}
                            </h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($colors as $color)
                                    <label class="color-filter-label" title="{{ $color->name }}">
                                        <input type="checkbox" name="colors[]" value="{{ $color->id }}"
                                            class="d-none color-filter-input"
                                            {{ in_array($color->id, request('colors', [])) ? 'checked' : '' }}>
                                        <span class="color-filter-swatch" style="background-color: {{ $color->hex_code ?? $color->code ?? '#ccc' }};"></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark rounded-0 btn-sm flex-fill text-uppercase fw-bold">
                            {{ __('front.apply_filters') }}
                        </button>
                        @if(request()->anyFilled(['sizes', 'colors', 'min_price', 'max_price', 'sort']))
                            <a href="{{ route('categories.products', ['id' => $category->id, 'slug' => $category->slug]) }}"
                                class="btn btn-outline-secondary rounded-0 btn-sm text-uppercase fw-bold">
                                {{ __('front.reset') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">

                <!-- Sort bar -->
                <div class="d-flex justify-content-end align-items-center mb-3">
                    <select name="sort" id="sortSelect" class="form-select form-select-sm rounded-0 shadow-none" style="width: auto;">
                        <option value="latest" {{ request('sort', 'latest') === 'latest' ? 'selected' : '' }}>
                            {{ __('front.sort_latest') }}
                        </option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                            {{ __('front.sort_oldest') }}
                        </option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>
                            {{ __('front.sort_price_asc') }}
                        </option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>
                            {{ __('front.sort_price_desc') }}
                        </option>
                    </select>
                </div>

                @if($products->isEmpty())
                    <div class="text-center py-5">
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
                @else
                    <div class="row g-3">
                        @foreach ($products as $product)
                            <div class="col-6 col-md-4">
                                <div class="product-card">
                                    <div class="position-relative p-3 text-center">
                                        {{-- <button class="btn btn-sm position-absolute top-0 end-0 m-2 p-0 text-dark border-0 bg-transparent">
                                            <i class="bi bi-heart fs-5"></i>
                                        </button> --}}
                                        <a href="{{ route('products.show', ['id' => $product->id, 'slug' => $product->slug]) }}">
                                            <img src="{{ $product->getFirstMediaUrl('images', 'optimized') }}" loading="lazy"
                                                class="img-fluid mix-blend-multiply product-img"
                                                alt="{{ $product->currentTranslation->name }}">
                                        </a>
                                    </div>
                                    <div class="mt-2 text-start product-footer">
                                        <a href="{{ route('products.show', ['id' => $product->id, 'slug' => $product->slug]) }}"
                                            class="text-muted text-decoration-none">
                                            <p class="m-0 text-muted text-uppercase fs-6">{{ $product->currentTranslation->name }}</p>
                                        </a>
                                        <span class="fw-bold small" style="font-size: 0.8rem;">
                                            {{ format_currency($product->minVariantPrice->price, current_currency_code()) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('assets/js/front/pages/category/category.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                // submit الفورم تلقائي لما يدوس على مقاس أو لون (اختياري - UX أسرع)
                $('.size-filter-input, .color-filter-input').on('change', function () {
                    $('#filterForm').submit();
                });

                // الترتيب بيرسل الفورم مع باقي الفلاتر
                $('#sortSelect').on('change', function () {
                    const sortValue = $(this).val();

                    // نبني URL جديد بالـ query params الحالية + الـ sort
                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', sortValue);
                    window.location.href = url.toString();
                });

            });
        </script>
    @endpush
</x-front.layout>