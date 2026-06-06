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
