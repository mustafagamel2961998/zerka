<x-dashboard.layout title="{{ __('dashboard.cities') }}">

    <div class="row">

        <x-dashboard.partial.city.statistics/>

    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">
                        {{ __('global.table-title', ['name' => __('dashboard.' . request()->segment(3))]) }}
                    </h4>

                    <a href="{{ route('dashboard.v1.cities.create') }}" class="btn btn-sm btn-primary">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.city')]) }}
                    </a>

                    <x-dashboard.partial.data-action />
                </div>
                <div class="p-1">
                    @include('dashboard.city.data-list', [
                        'cities' => $cities, 
                        ])
                    <!-- end table-responsive -->
                </div>
                <div class="card-footer border-top">
                    {{ $cities->links() }}
                </div>
            </div>
        </div>
    </div>
 
    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/city/city.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/city/city.js') }}"></script>
    @endpush
</x-dashboard.layout>
