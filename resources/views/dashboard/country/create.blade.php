<x-dashboard.layout title="{{ __('dashboard.countries') }}">

    <div class="row">

        <x-dashboard.partial.status-card :counts="$counts" />

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="" method="POST">
                            @csrf
                            @include('dashboard.country._form', ['country' => $country])
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-dashboard.layout>
