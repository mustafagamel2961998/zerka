<x-dashboard.layout title="{{ __('global.edit_with_attribute', ['attribute' => __('dashboard.currency')]) }} - {{$currency->currentTranslation->name }}">

    <div class="row">
         <x-dashboard.partial.currency.statistics/>
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
                       
                        <form action="{{ route('dashboard.v1.currencies.update', $currency->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('dashboard.currency._form', [
                                    'currency' => $currency,
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
