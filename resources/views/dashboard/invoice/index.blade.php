<x-dashboard.layout title="{{ __('dashboard.invoices') }}">

    <div class="row">

        <x-dashboard.partial.invoice.statistics />

    </div>



    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <div>
                        {{ __('global.table-title', ['name' => __('dashboard.' . request()->segment(3))]) }}
                    </div>
                   
                </div>
                  @if($invoices->isEmpty())
                     <div class="card p-5 text-center border-0 shadow-sm">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div class="bg-light-subtle rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <iconify-icon icon="solar:folder-empty-broken" class="text-muted" style="font-size: 45px;"></iconify-icon>
                                </div>
                                <h5 class="text-dark fw-semibold mb-1">{{ __('global.no_data_found') }}</h5>
                                <p class="text-muted mb-0 fs-13">{{ __('global.no_records_have_been_added_to_this_table_yet') }}</p>
                                <a href="{{ route('dashboard.v1.colors.create') }}" class="btn btn-primary btn-sm mt-3">
                                    <iconify-icon icon="solar:add-circle-broken" class="align-middle me-1"></iconify-icon>
                                    {{ __('global.add_new') }}
                                </a>
                            </div>
                        </div>
                    @else
                    <div class="card-body p-0">
                        @include('dashboard.invoice.data-list', [
                                'invoices' => $invoices, 
                                ])
                        <!-- end table-responsive -->
                    </div>
                @endif
                <div class="card-footer border-top">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>

    </div>


    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/invoice/invoice.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/invoice/invoice.js') }}"></script>
    @endpush
</x-dashboard.layout>
