 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="country_name_ar" class="form-label">
                {{ __('form.country_name_ar') }}
            </label>
            <input type="text" name="name[ar]" id="country_name_ar" class="form-control" placeholder="{{ __('form.country_name_ar') }}">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="country_name_en" class="form-label">
                {{ __('form.country_name_en') }}
            </label>
            <input type="text" name="name[en]" id="country_name_en" class="form-control" placeholder="{{ __('form.country_name_en') }}">
        </div>
    </div>


</div>


 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="iso2_code" class="form-label">
                {{ __('form.iso2_code') }}
            </label>
            <input type="text" name="iso2" id="iso2_code" class="form-control" placeholder="{{ __('form.iso2_code') }}">
        </div>
    </div>

      <div class="col-lg-6">
        <div class="mb-3">
            <label for="iso3_code" class="form-label">
                {{ __('form.iso3_code') }}
            </label>
            <input type="text" name="iso3" id="iso3_code" class="form-control" placeholder="{{ __('form.iso3_code') }}">
        </div>
    </div>

</div>

 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="phone_code" class="form-label">
                {{ __('form.phone_code') }}
            </label>
            <input type="text" name="phone_code" id="phone_code" class="form-control" placeholder="{{ __('form.phone_code') }}">
        </div>
    </div>

      <div class="col-lg-6">
        <div class="mb-3">
            <label for="timezone" class="form-label">
                {{ __('form.timezone') }}
            </label>
            <input type="text" name="iso3" id="timezone" class="form-control" placeholder="{{ __('form.timezone') }}">
        </div>
    </div>

</div>


<div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
            <label for="choices_currency_id" class="form-label">Add Workspace</label>
            <select class="form-control" id="choices_currency_id" name="currency_id" data-choices data-choices-sorting-false>
                @foreach($currencies as $currency)
                <option value="{{ $currency->id }}" {{ old('currency_id', $country->currency_id ?? '') == $currency->id ? 'selected' : '' }}>
                        {{ $currency->translation->name }} ({{ $currency->translation?->symbol ?? $currency->code }})
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="status" class="form-label">
                {{ __('form.currency') }}
            </label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="status" role="switch">
            </div>
        </div>
    </div>
</div>

<div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">
                {{ $btn_text }}
            </button>
        </div>
   </div>
</div>
