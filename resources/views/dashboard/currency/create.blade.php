<x-dashboard.layout title="{{ __('global.add_with_attribute', ['attribute' => __('dashboard.currency')]) }}">

    <div class="row">

        <x-dashboard.partial.status-card :counts="$counts" />

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.currency')]) }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                       
                        <form action="{{ route('v1.dashboard.currencies.store') }}" method="POST">
                            @csrf
                            @include('dashboard.currency._form', [
                                    'currency' => $currency,
                                    'currencies' => $currencies,
                                    'btn_text' => __('global.add_with_attribute', ['attribute' => __('dashboard.currency')])
                                ])
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/dashboard/pages/currency/currency.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/pages/jquery/currency/currency.js') }}"></script>

</x-dashboard.layout>
