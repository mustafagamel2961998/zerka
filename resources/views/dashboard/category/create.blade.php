<x-dashboard.layout title="{{ __('global.add_with_attribute', ['attribute' => __('dashboard.category')]) }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard/pages/category/category.css') }}">
    @endpush
    <div class="row">

        <x-dashboard.partial.city.statistics/>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.category')]) }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                       
                        <form action="{{ route('dashboard.v1.categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.category._form', [
                                    'category' => $category,
                                    'categories' => $categories,
                                    'btn_text' => __('global.add_with_attribute', ['attribute' => __('dashboard.category')])
                                ])
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/category/category.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/category/category.js') }}"></script>
    @endpush
</x-dashboard.layout>
