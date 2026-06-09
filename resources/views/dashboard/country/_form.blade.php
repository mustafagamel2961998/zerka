 @php
     use App\Enums\Status;
 @endphp
 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="country_name_ar" class="form-label required">
                {{ __('form.country_name_ar') }}
            </label>
            <input type="text" name="name[ar]" id="country_name_ar" class="form-control @error('name.ar') is-invalid @enderror" 
            value="{{old('name.ar',$country->translations->where('locale', 'ar')->first()->name ?? '')}}" 
            placeholder="{{ __('form.country_name_ar') }}">
            @error('name.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="country_name_en" class="form-label required">
                {{ __('form.country_name_en') }}
            </label>
            <input type="text" name="name[en]" id="country_name_en" class="form-control @error('name.en') is-invalid @enderror" 
            value="{{old('name.en',$country->translations->where('locale', 'en')->first()->name ?? '')}}" 
            placeholder="{{ __('form.country_name_en') }}">
             @error('name.en')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>


</div>


 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="iso2_code" class="form-label required">
                {{ __('form.iso2_code') }} : {{__('global.example')}} - [ {{ __('form.iso2_code_example') }} ]
            </label>
            <input type="text" name="iso2" id="iso2_code" class="form-control @error('iso2') is-invalid @enderror" value="{{old('iso2',$country->iso2)}}" placeholder="{{ __('form.iso2_code') }}">
            @error('iso2')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

      <div class="col-lg-6">
        <div class="mb-3">
            <label for="iso3_code" class="form-label required">
                {{ __('form.iso3_code') }} : {{__('global.example')}} - [ {{ __('form.iso3_code_example') }} ]
            </label>
            <input type="text" name="iso3" id="iso3_code" class="form-control @error('iso3') is-invalid @enderror" value="{{old('iso3',$country->iso3)}}" placeholder="{{ __('form.iso3_code') }}">
            @error('iso3')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

</div>

 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="phone_code" class="form-label">
                {{ __('form.phone_code') }} : {{__('global.example')}} - [ {{ __('form.phone_code_example') }} ]
            </label>
            <input type="text" name="phone_code" id="phone_code" class="form-control @error('phone_code') is-invalid @enderror" value="{{old('phone_code',$country->phone_code)}}"  placeholder="{{ __('form.phone_code') }}">
            @error('phone_code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

      <div class="col-lg-6">
        <div class="mb-3">
            <label for="timezone" class="form-label">
                {{ __('form.timezone') }} : {{__('global.example')}} - [ {{ __('form.timezone_example') }} ]
            </label>
            <input type="text" name="timezone" id="timezone" class="form-control @error('timezone') is-invalid @enderror" value="{{old('timezone',$country->timezone)}}" placeholder="{{ __('form.timezone') }}">
            @error('timezone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

</div>


<div class="row d-flex align-items-center">
      <div class="col-lg-6">
        <div class="mb-3">
            <label for="choices_currency_id" class="form-label">
                {{__('form.currency')}}
            </label>
            <select class="form-control" id="choices_currency_id" name="currency_id" data-choices data-choices-sorting-false>
                @if(old('currency_id', $country->currency_id ?? '') == null)
                    <option value="" selected disabled>
                        {{__('form.select_currency')}}
                    </option>
                @endif
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}" {{ old('currency_id', $country->currency_id ?? '') == $currency->id ? 'selected' : '' }}>
                            {{ $currency->translation->name }} ({{ $currency->translation?->symbol ?? $currency->code }})
                    </option>
                @endforeach
            </select>
            @error('currency_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

  
</div>
<div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
            
            <div class="form-check form-switch">
                <label for="status" class="form-label required">{{ __('form.status') }}</label>
              
                <input class="form-check-input" type="checkbox" id="status" name="status" role="switch"
                @checked(old('status', $country->status) === Status::ACTIVE)>
                @error('status')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
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
