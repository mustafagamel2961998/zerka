<x-dashboard.layout title="{{$country->translation->name }}">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="avatar avatar-md rounded-circle bg-primary-subtle text-primary fw-semibold d-flex align-items-center justify-content-center">
                        {{ strtoupper(substr($country->iso2, 0, 2)) }}
                    </div>
                    <div>
                        <h5 class="mb-0">{{ $country->translation->name }}</h5>
                        <span class="text-muted small">{{ $country->iso2 }} / {{ $country->iso3 }}</span>
                    </div>
                    <span class="ms-auto badge {{ $country->status ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                        {{ $country->status ? __('global.active') : __('global.inactive') }}
                    </span>
                </div>

                <div class="border-top pt-3">
                    <div class="row g-3">
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="p-3 bg-light rounded">
                                <p class="text-muted small mb-1"><i class="ti ti-id me-1"></i>{{__('global.iso2')}}</p>
                                <p class="fw-semibold mb-0">{{ $country->iso2 }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="p-3 bg-light rounded">
                                <p class="text-muted small mb-1"><i class="ti ti-id-badge-2 me-1"></i>{{__('global.iso3')}}</p>
                                <p class="fw-semibold mb-0">{{ $country->iso3 }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="p-3 bg-light rounded">
                                <p class="text-muted small mb-1"><i class="ti ti-phone me-1"></i>{{ __('global.phone_code') }}</p>
                                <p class="fw-semibold mb-0">{{ $country->phone_code }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="p-3 bg-light rounded">
                                <p class="text-muted small mb-1"><i class="ti ti-clock me-1"></i>{{ __('global.timezone') }}</p>
                                <p class="fw-semibold mb-0">{{ $country->timezone }}</p>
                            </div>
                        </div>
                        @if($country->currency)
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="p-3 bg-light rounded">
                                <p class="text-muted small mb-1"><i class="ti ti-currency-dollar me-1"></i>{{ __('global.currency') }}</p>
                                <p class="fw-semibold mb-0">{{ $country->currency->code }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-xl-2">
                            <div class="p-3 bg-light rounded">
                                <p class="text-muted small mb-1"><i class="ti ti-trending-up me-1"></i>{{ __('global.exchange_rate') }}</p>
                                <p class="fw-semibold mb-0">                            
                                    {{ number_format($country->currency->exchange_rate, $country->currency->decimal_places) }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">
                        {{__('global.details') }} - {{$country->translation->name }}
                    </h4>

                    <a href="{{ route('dashboard.v1.cities.create') }}" class="btn btn-sm btn-primary">
                        {{ __('global.add_with_attribute', ['attribute' => __('dashboard.city')]) }}
                    </a>

                </div>
                <div class="p-1">
                    @include('dashboard.city.data-list', [
                        'country'=>$country,
                        'cities' => $country->cities
                        ])
                    <!-- end table-responsive -->
                </div>
                
            </div>
        </div>
    </div>
 
    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/country/country.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/country/country.js') }}"></script>
    @endpush
</x-dashboard.layout>
