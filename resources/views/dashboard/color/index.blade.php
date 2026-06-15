<x-dashboard.layout title="{{ __('dashboard.colors') }}">

    <div class="row">

        <x-dashboard.partial.color.statistics/>

    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">
                        {{ __('global.table-title', ['name' => __('dashboard.' . request()->segment(3))]) }}
                    </h4>

                    <a href="{{ route('dashboard.v1.colors.create') }}" class="btn btn-sm btn-primary">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.color')]) }}
                    </a>

                </div>
                    @if($colors->isEmpty())
                     <div class="card p-5 text-center border-0 shadow-sm">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <div class="bg-light-subtle rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                    <iconify-icon icon="solar:folder-empty-broken" class="text-muted" style="font-size: 45px;"></iconify-icon>
                                </div>
                                <h5 class="text-dark fw-semibold mb-1">{{ __('global.no_data_found') }}</h5>
                                <p class="text-muted mb-0 fs-13">{{ __('global.no_records_have_been_added_to_this_table_yet') }}</p>
                                <a href="#!" class="btn btn-primary btn-sm mt-3">
                                    <iconify-icon icon="solar:add-circle-broken" class="align-middle me-1"></iconify-icon>
                                    {{ __('global.add_new') }}
                                </a>
                            </div>
                        </div>
                    @else
                    <div class="p-1">
                        @include('dashboard.color.data-list', [
                            'colors' => $colors, 
                            ])
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        {{ $colors->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
 
    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/color/color.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/color/color.js') }}"></script>
    @endpush
</x-dashboard.layout>
