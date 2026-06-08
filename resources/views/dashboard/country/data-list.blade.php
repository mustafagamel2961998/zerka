<div class="table-responsive">
    <table id="my-html-table" class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <th>{{ __('global.number') }}</th>
                <th>{{ __('global.name') }}</th>
                <th>{{ __('global.iso2') }}</th>
                <th>{{ __('global.iso3') }}</th>
                <th>{{ __('global.phone_code') }}</th>
                <th>{{ __('global.timezone') }}</th>
                <th>{{ __('global.currency_name') }}</th>
                <th>{{ __('global.code') }}</th>
                <th>{{ __('global.exchange_rate') }}</th>
                <th>{{ __('global.status') }}</th>
                <th>{{ __('global.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($countries as $key => $country)
                <tr>
                    <td>
                        {{ $key + 1 }}
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-dark fw-medium fs-15 mb-0">
                                <span class="fi fi-{{ strtolower($country->iso2) }}"></span>
                                {{ $country->translation->name }}
                            </p>
                        </div>
                    </td>
                    <td>
                        {{ $country->iso2 }}
                    </td>
                    <td>
                        {{ $country->iso3 }}
                    </td>
                    <td>
                        {{ $country->phone_code }}
                    </td>
                    <td>
                        {{ $country->timezone }}
                    </td>
                    <td>
                        {{ $country->currency->translation->name }}
                    </td>
                    <td>
                        {{ $country->currency->code }}
                    </td>
                  <td class="whitespace-nowrap px-4 py-3 align-middle text-right font-medium text-slate-900">
                        <span dir="ltr" class="font-semibold text-indigo-600">
                            {{ number_format($country->currency->exchange_rate, $country->currency->decimal_places) }}
                        </span>
                        
                        <span class="mr-1.5 text-xs text-slate-500 font-normal">
                            {{ $country->currency->translation->name }} 
                            <span class="text-slate-400 font-mono uppercase">
                                ({{ $country->currency->code }})
                            </span>
                        </span>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" role="switch" @checked($country->status->value === 'active')>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="#!" class="btn btn-light btn-sm">
                                <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                            </a>
                            <a href="#!" class="btn btn-soft-primary btn-sm">
                                <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                            </a>
                            <a href="#!" class="btn btn-soft-danger btn-sm">
                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                    class="align-middle fs-18"></iconify-icon>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <div class="bg-light-subtle rounded-circle d-flex align-items-center justify-content-center mb-3"
                                style="width: 80px; height: 80px;">
                                <iconify-icon icon="solar:folder-empty-broken" class="text-muted"
                                    style="font-size: 45px;"></iconify-icon>
                            </div>

                            <h5 class="text-dark fw-semibold mb-1">{{ __('global.no_data_found') }}</h5>
                            <p class="text-muted mb-0 fs-13">
                                {{ __('global.no_records_have_been_added_to_this_table_yet') }}
                            </p>

                            <a href="#!" class="btn btn-primary btn-sm mt-3">
                                <iconify-icon icon="solar:add-circle-broken" class="align-middle me-1"></iconify-icon>
                                {{ __('global.add_new') }}
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse


        </tbody>
    </table>
</div>
<div id="table-gridjs"></div>
