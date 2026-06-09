<x-dashboard.layout title="{{$country->translation->name }}">

    <div class="row">
{{-- 
        <x-dashboard.partial.country.statistics/> --}}

    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">
                        {{__('dashboard.details') }} - {{$country->translation->name }}
                    </h4>

                    <a href="{{ route('dashboard.v1.countries.create') }}" class="btn btn-sm btn-primary">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.country')]) }}
                    </a>

                    <x-dashboard.partial.data-action />
                </div>
                <div class="p-1">
                    @include('dashboard.city.data-list', ['country'=>$country,'cities' => $country->cities])
                    <!-- end table-responsive -->
                </div>
                
            </div>
        </div>
    </div>
 
    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/country/country.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/city/city.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/country/country.js') }}"></script>
    @endpush
</x-dashboard.layout>
