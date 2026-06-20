<x-dashboard.layout title="{{ __('global.add_with_attribute', ['attribute' => __('dashboard.product')]) }}">

    <div class="row">

        {{-- <x-dashboard.partial.city.statistics/> --}}

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.product')]) }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                   
                        <form action="{{ route('dashboard.v1.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.product._form', [
                                    'product' => $product,
                                    'categories' => $categories,
                                    'warehouses' => $warehouses,
                                    'sizes' => $sizes,
                                    'colors' => $colors,
                                    'btn_text' => __('global.add_with_attribute', ['attribute' => __('dashboard.product')])
                                ])
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/product/product.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/product/product.js') }}"></script>
    @endpush
</x-dashboard.layout>
