 @php
     use App\Enums\Status;
 @endphp
 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="currency_name_ar" class="form-label">
                {{ __('form.currency_name_ar') }}
            </label>
            <input type="text" name="name[ar]" id="currency_name_ar" class="form-control @error('name.ar') is-invalid @enderror" value="{{old('name.ar',$currency->translations->where('locale', 'ar')->first()?->name)}}" placeholder="{{ __('form.currency_name_ar') }}">
            @error('name.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="currency_name_en" class="form-label">
                {{ __('form.currency_name_en') }}
            </label>
            <input type="text" name="name[en]" id="currency_name_en" class="form-control @error('name.en') is-invalid @enderror" value="{{old('name.en',$currency->translations->where('locale', 'en')->first()?->name)}}" placeholder="{{ __('form.currency_name_en') }}">
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
            <label for="currency_symbol_ar" class="form-label">
                {{ __('form.currency_symbol_ar') }}
            </label>
            <input type="text" name="symbol[ar]" id="currency_symbol_ar" class="form-control @error('symbol.ar') is-invalid @enderror" value="{{old('symbol.ar',$currency->translations->where('locale', 'ar')->first()?->symbol)}}" placeholder="{{ __('form.currency_symbol_ar') }}">
            @error('symbol.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="currency_symbol_en" class="form-label">
                {{ __('form.currency_symbol_en') }}
            </label>
            <input type="text" name="symbol[en]" id="currency_symbol_en" class="form-control @error('symbol.en') is-invalid @enderror" value="{{old('symbol.en',$currency->translations->where('locale', 'en')->first()?->symbol)}}" placeholder="{{ __('form.currency_symbol_en') }}">
            @error('symbol.en')
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
            <label for="code" class="form-label">
                {{ __('form.code') }}
            </label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{old('code',$currency->code)}}" placeholder="{{ __('form.code') }}">
            @error('code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

      <div class="col-lg-6">
        <div class="mb-3">
            <label for="exchange_rate" class="form-label">
                {{ __('form.exchange_rate') }} => ( {{ __('form.exchange_rate_description') }} )
            </label>
            <input type="text" name="exchange_rate" id="exchange_rate" class="form-control @error('exchange_rate') is-invalid @enderror" value="{{old('exchange_rate',number_format($currency->exchange_rate, $currency->decimal_places))}}" placeholder="{{ __('form.exchange_rate') }}">
            @error('exchange_rate')
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
            <label for="decimal_places" class="form-label">
                {{ __('form.decimal_places') }}
            </label>
            <input type="text" name="decimal_places" id="decimal_places" class="form-control @error('decimal_places') is-invalid @enderror"  value="{{old('decimal_places',$currency->decimal_places)}}" placeholder="{{ __('form.decimal_places') }}">
            @error('decimal_places')
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
                @checked(old('status', $currency->status?->value) === Status::ACTIVE->value)>
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
