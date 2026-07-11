<x-front.layout title="{{ $category->currentTranslation->name }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/category/category.css') }}">
    @endpush

    <div class="container py-5">

        <!-- Breadcrumb / Header -->
        <div class="mb-5 border-bottom border-light-subtle pb-3">
            <p class="text-muted small mb-1">
                <a href="{{ route('home') }}" class="text-muted text-decoration-none">{{ __('front.home') }}</a>
                / <span class="text-dark">{{ $category->currentTranslation->name }}</span>
            </p>
            <h3 class="fw-bold text-uppercase tracking-wider fs-4 mb-1">
                {{ $category->currentTranslation->name }}
            </h3>
            @if($category->currentTranslation->description)
                <p class="text-muted small mb-0" style="max-width: 600px;">
                    {{ $category->currentTranslation->description }}
                </p>
            @endif
        </div>

        <!-- Sub Categories Grid -->
        <div class="row g-3">
            @foreach ($category->children as $child)
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="{{ route('categories.products', ['id' => $child->id, 'slug' => $child->slug]) }}"
                        class="text-decoration-none">
                        <div class="subcategory-card position-relative overflow-hidden bg-dark text-white d-flex align-items-end"
                            style="background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.75)), url({{ $child->getFirstMediaUrl('cover', 'optimized') }}) center/cover no-repeat; aspect-ratio: 3/4;">
                            <div class="p-3 w-100">
                                <h6 class="fw-bold text-uppercase m-0 tracking-wide fs-6 text-white">
                                    {{ $child->currentTranslation->name }}
                                </h6>
                                <span class="text-white-50 small">
                                    {{ __('front.products_count', ['count' => $child->products->count()]) }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</x-front.layout>