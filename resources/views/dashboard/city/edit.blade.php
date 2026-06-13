<x-dashboard.layout title="{{ __('global.edit_with_attribute', ['attribute' => __('dashboard.city')]) }} - {{$city->translation->name }}">

    <div class="row">

        <x-dashboard.partial.city.statistics/>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('global.edit_with_attribute', ['attribute' => __('dashboard.city')]) }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                       
                        <form action="{{ route('dashboard.v1.cities.update',$city->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('dashboard.city._form', [
                                    'city' => $city,
                                    'countries' => $countries,
                                    'btn_text' => __('global.edit_with_attribute', ['attribute' => __('dashboard.city')])
                                ])
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/city/city.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/city/city.js') }}"></script>
    @endpush
</x-dashboard.layout>
