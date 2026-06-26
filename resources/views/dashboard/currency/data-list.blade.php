<div class="table-responsive">
    <table id="my-currency-html-table" class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <th>{{ __('global.number') }}</th>
                <th>{{ __('global.currency_name') }}</th>
                <th>{{ __('global.code') }}</th>
                <th>{{ __('global.exchange_rate') }}</th>
                <th>{{ __('global.decimal_places') }}</th>
                <th>{{ __('global.status') }}</th>
                <th>{{ __('global.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($currencies as $currency)
                <tr>
                    <td>
                        {{ $loop->iteration}}
                    </td>
                    <td>
                        {{ $currency->currentTranslation->name }}
                    </div>
                    </td>
                    <td>
                        {{ $currency->code }}
                    </td>
                    <td>
                        {{ $currency->exchange_rate }}
                    </td>
                    <td>
                        {{ $currency->decimal_places }}
                    </td>
                      <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" role="switch" @checked($currency->status->value === 'active')>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{route('dashboard.v1.currencies.edit', $currency->id)}}" class="btn btn-soft-primary btn-sm">
                                <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                            </a>
                            <button type="button" class="btn btn-soft-danger btn-sm open-delete-modal"
                                    data-url="{{ route('dashboard.v1.currencies.destroy', $currency->id) }}" 
                                    data-name="{{ $currency->currentTranslation->name}}">
                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                            </button>
                            
                        </div>
                    </td>
                  
                </tr>
                @endforeach


        </tbody>
    </table>
</div>
<div id="table-currency-gridjs"></div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            
            <div class="modal-body text-center p-4">
                
                <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3" style="width: 64px; height: 64px;">
                    <iconify-icon icon="solar:danger-triangle-bold-duotone" style="font-size: 36px;"></iconify-icon>
                </div>

                <h4 class="text-dark fw-bold mb-2">{{ __('global.delete_confirmation') }}</h4>
                
                <p class="text-muted fs-15 mb-3">
                    {{ __('global.delete_warning_title', ['name' => __('dashboard.currency')]) }}
                    <strong id="name-span" class="text-dark fw-semibold d-block mt-1 fs-16"></strong>
                </p>

                <div class="alert alert-danger border-0 d-flex align-items-start text-start gap-2 mb-3 py-2 px-3 fs-13" role="alert">
                    <iconify-icon icon="solar:info-circle-bold" class="fs-18 mt-0.5 flex-shrink-0"></iconify-icon>
                    <div>
                        <strong>{{ __('global.delete_cascade_warning') }}</strong>
                    </div>
                </div>

                <p class="text-secondary small mb-0 fs-12">
                    <iconify-icon icon="solar:lock-password-broken" class="align-middle me-1"></iconify-icon>
                    {{ __('global.cannot_undo') }}
                </p>
            </div>

            <div class="modal-footer border-0 bg-light-subtle d-flex justify-content-center gap-2 pb-4 pt-0 px-4">
                <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                    {{ __('global.cancel') }}
                </button>
                
                <form id="modal-delete-form" action="" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger fw-medium px-4" style="border-radius: 8px;">
                        {{ __('global.confirm_delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
