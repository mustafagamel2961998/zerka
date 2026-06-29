<x-dashboard.layout title="{{ __('dashboard.orders') }}">

    <div class="row">

        <x-dashboard.partial.order.statistics/>

    </div>



    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">
                            {{ __('global.table-title', ['name' => __('dashboard.' . request()->segment(3))]) }}
                        </h4>
                    </div>
                    
                </div>
                    @if($orders->isEmpty())
                      <div class="card p-5 text-center border-0 shadow-sm">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div class="bg-light-subtle rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <iconify-icon icon="solar:folder-empty-broken" class="text-muted" style="font-size: 45px;"></iconify-icon>
                                </div>
                                <h5 class="text-dark fw-semibold mb-1">{{ __('global.no_data_found') }}</h5>
                                <p class="text-muted mb-0 fs-13">{{ __('global.no_records_have_been_added_to_this_table_yet') }}</p>
                            </div>
                        </div>
                    @else
                    <div class="p-1">
                        @include('dashboard.order.data-list', [
                                'orders' => $orders, 
                            ])
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        {{ $orders->links() }}
                    </div>
                @endif

                
            </div>
        </div>

    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/order/order.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/order/order.js') }}"></script>
    @endpush
</x-dashboard.layout>
