<x-dashboard.layout title="{{ __('dashboard.currencies') }}">

    <div class="row">

        <x-dashboard.partial.status-card :counts="$counts"/>

    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">
                        {{ __('dashboard.table-title', ['name' => __('dashboard.' . request()->segment(3))]) }}
                    </h4>

                    <a href="{{ route('v1.dashboard.countries.create') }}" class="btn btn-sm btn-primary">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.country')]) }}
                    </a>

                    <x-dashboard.partial.data-action />
                </div>
                <div>
                    @include('dashboard.country.data-list', ['countries' => $countries])
                    <!-- end table-responsive -->
                </div>
                <div class="card-footer border-top">
                    {{ $countries->links() }}
                </div>
            </div>
        </div>
    </div>

</x-dashboard.layout>
