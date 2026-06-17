<x-dashboard.layout title="{{ __('global.edit_with_attribute', ['attribute' => __('dashboard.warehouse')]) }} - {{$warehouse->currentTranslation->name }}">

    <div class="row">

        {{-- <x-dashboard.partial.city.statistics/> --}}

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('global.edit_with_attribute', ['attribute' => __('dashboard.warehouse')]) }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                       
                        <form action="{{ route('dashboard.v1.warehouses.update',$warehouse->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('dashboard.warehouse._form', [
                                    'warehouse' => $warehouse,
                                    'countries' => $countries,
                                    'btn_text' => __('global.edit_with_attribute', ['attribute' => __('dashboard.warehouse')])
                                ])
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/warehouse/warehouse.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/warehouse/warehouse.js') }}"></script>
    @endpush
</x-dashboard.layout>
