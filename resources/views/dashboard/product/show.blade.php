<x-dashboard.layout
    title="{{ __('global.show_with_attribute', ['attribute' => __('dashboard.product')]) }} - {{ $product->currentTranslation->name }}">

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <!-- Crossfade -->
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner rounded" role="listbox">
                            @forelse($product->getMedia('images') as $media)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ $media->getUrl('optimized') }}"
                                        alt="{{ $product->currentTranslation->name }}"
                                        class="img-fluid bg-light rounded product-img w-100">
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                        style="height:300px;">
                                        <iconify-icon icon="solar:gallery-broken"
                                            class="fs-48 text-muted"></iconify-icon>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        @if ($product->getMedia('images')->count() > 1)
                            <a class="carousel-control-prev rounded" href="#carouselExampleFade" role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next rounded" href="#carouselExampleFade" role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>

                            <div
                                class="carousel-indicators m-0 mt-2 d-flex position-static h-100 product-carousel flex-wrap gap-1">
                                @foreach ($product->getMedia('images') as $index => $media)
                                    <button type="button" data-bs-target="#carouselExampleFade"
                                        data-bs-slide-to="{{ $index }}"
                                        aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"
                                        class="w-auto h-auto rounded bg-light p-0 border {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ $media->getUrl('thumb') }}" class="d-block avatar-md  rounded"
                                            alt="thumb">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="text-dark fw-semibold mb-1">{{ $product->currentTranslation->name }}</h4>
                            <p class="text-muted mb-0 fs-13">{{ $product->code }}</p>
                        </div>

                        @php
                            $statusBadge = match ($product->status->value) {
                                'active' => ['success', __('global.active')],
                                'inactive' => ['danger', __('global.inactive')],
                                'draft' => ['warning', __('global.draft')],
                                default => ['secondary', $product->status->value],
                            };
                        @endphp
                        <span
                            class="badge bg-{{ $statusBadge[0] }}-subtle text-{{ $statusBadge[0] }} fs-13 px-2 py-1">
                            <i class="bx bxs-circle fs-10 align-middle me-1"></i>{{ $statusBadge[1] }}
                        </span>
                    </div>

                    <hr class="my-3">

                    <div class="row g-3 text-center">
                        <div class="col-4">
                            <div class="p-2 rounded bg-light-subtle">
                                <iconify-icon icon="solar:hashtag-square-bold-duotone"
                                    class="fs-24 text-primary"></iconify-icon>
                                <p class="text-muted fs-12 mb-0 mt-1">{{ __('global.id') }}</p>
                                <p class="fw-medium text-dark mb-0">#{{ $product->id }}</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 rounded bg-light-subtle">
                                <iconify-icon icon="solar:widget-4-bold-duotone"
                                    class="fs-24 text-primary"></iconify-icon>
                                <p class="text-muted fs-12 mb-0 mt-1">{{ __('global.variants') }}</p>
                                <p class="fw-medium text-dark mb-0">{{ $product->variants->count() }}</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2 rounded bg-light-subtle">
                                <iconify-icon icon="solar:gallery-wide-bold-duotone"
                                    class="fs-24 text-primary"></iconify-icon>
                                <p class="text-muted fs-12 mb-0 mt-1">{{ __('global.images') }}</p>
                                <p class="fw-medium text-dark mb-0">{{ $product->getMedia('images')->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    <ul class="d-flex flex-column gap-2 list-unstyled fs-14 mb-0">
                        <li class="d-flex justify-content-between">
                            <span class="text-muted"><i class="bx bx-link-alt me-1"></i>{{ __('global.slug') }}</span>
                            <span class="fw-medium text-dark">{{ $product->slug }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-muted"><i
                                    class="bx bx-category me-1"></i>{{ __('global.category') }}</span>
                            <span
                                class="fw-medium text-dark">{{ $product->category?->currentTranslation->name ?? '-' }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-muted"><i
                                    class="bx bx-calendar-plus me-1"></i>{{ __('global.created_at') }}</span>
                            <span class="fw-medium text-dark">{{ $product->created_at?->format('Y-m-d') }}</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-muted"><i
                                    class="bx bx-calendar-edit me-1"></i>{{ __('global.updated_at') }}</span>
                            <span class="fw-medium text-dark">{{ $product->updated_at?->format('Y-m-d') }}</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ __('global.description') }}</h4>
                </div>
                <div class="card-body">
                    @if ($product->currentTranslation?->description)
                        <p class="text-muted mb-0">{{ $product->currentTranslation->description }}</p>
                    @else
                        <p class="text-muted mb-0 fst-italic">{{ __('global.no_description') }}</p>
                    @endif

                    @if ($product->hasSeoData())
                        <hr class="my-3">
                        <h5 class="text-dark fw-medium mb-2">
                            <iconify-icon icon="solar:magnifer-bold-duotone" class="text-primary me-1"></iconify-icon>
                            {{ __('global.seo_data') }}
                        </h5>
                        @if ($product->currentTranslation->meta_title)
                            <p class="mb-1 fs-14"><span
                                    class="fw-medium text-dark">{{ __('global.meta_title') }}:</span>
                                {{ $product->currentTranslation->meta_title }}</p>
                        @endif
                        @if ($product->currentTranslation->meta_description)
                            <p class="mb-0 fs-14"><span
                                    class="fw-medium text-dark">{{ __('global.meta_description') }}:</span>
                                {{ $product->currentTranslation->meta_description }}</p>
                        @endif
                    @endif
                </div>
            </div>

            @if ($product->currentTranslation?->long_description)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <iconify-icon icon="solar:document-text-bold-duotone"
                                class="text-primary me-1"></iconify-icon>
                            {{ __('global.long_description') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="text-muted long-description-content">
                            {!! $product->currentTranslation->long_description !!}
                        </div>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">{{ __('global.variants') }}</h4>
                    <span class="badge bg-primary-subtle text-primary fs-13">
                        {{ $product->variants->count() }} {{ __('global.variant') }}
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-centered table-hover align-middle mb-0">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('global.sku') }}</th>
                                    <th>{{ __('global.color') }}</th>
                                    <th>{{ __('global.size') }}</th>
                                    <th>{{ __('global.price') }}</th>
                                    <th>{{ __('global.quantity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product->variants as $variant)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="fw-medium text-dark">{{ $variant->sku }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                            @foreach ($variant->colors as $color)
                                                    <span class="d-inline-block rounded-circle border"
                                                        style="width:18px;height:18px;background-color: {{ $color->color->code }};">
                                                    </span>
                                            @endforeach
                                           </div>
                                           
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-light text-dark border px-2 py-1">{{ $variant->size->size }}</span>
                                        </td>
                                        <td class="fw-medium text-dark">{{ number_format($variant->price, 2) }}</td>
                                        <td>
                                            @php($qty = $variant->inventory->quantity ?? null)
                                            @if (!is_null($qty))
                                                <span
                                                    class="badge bg-{{ $qty > 0 ? 'success' : 'danger' }}-subtle text-{{ $qty > 0 ? 'success' : 'danger' }}">
                                                    {{ $qty }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-secondary-subtle text-secondary">{{ __('global.not_tracked') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            {{ __('global.no_variants_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if ($product->translations->count() > 1)
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">{{ __('global.translations') }}</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th>{{ __('global.locale') }}</th>
                                        <th>{{ __('global.name') }}</th>
                                        <th>{{ __('global.description') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->translations as $translation)
                                        <tr>
                                            <td><span
                                                    class="badge bg-secondary-subtle text-secondary">{{ strtoupper($translation->locale) }}</span>
                                            </td>
                                            <td class="fw-medium text-dark">{{ $translation->name }}</td>
                                            <td class="text-muted">{{ Str::limit($translation->description, 60) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        @push('javascript')
            <script src="{{ asset('assets/js/dashboard/pages/product/product.js') }}"></script>
        @endpush
</x-dashboard.layout>
