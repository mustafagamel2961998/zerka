<x-dashboard.layout title="{{ __('global.add_with_attribute', ['attribute' => __('dashboard.country')]) }}">

    <div class="row">

        <x-dashboard.partial.status-card :counts="$counts" />

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.country')]) }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                       
                        <form action="{{ route('v1.dashboard.countries.store') }}" method="POST">
                            @csrf
                            @include('dashboard.country._form', [
                                    'country' => $country,
                                    'currencies' => $currencies,
                                    'btn_text' => __('global.add_with_attribute', ['attribute' => __('dashboard.country')])
                                ])
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/dashboard/pages/country/country.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/pages/jquery/country/country.js') }}"></script>

</x-dashboard.layout>
