 @php
     use App\Enums\Status;
 @endphp

 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="warehouse_name_ar" class="form-label required">
                {{ __('form.warehouse_name_ar') }}
            </label>
            <input type="text" name="name[ar]" id="warehouse_name_ar" class="form-control @error('name.ar') is-invalid @enderror" 
            value="{{old('name.ar',$warehouse->translations->where('locale', 'ar')->first()->name ?? '')}}" 
            placeholder="{{ __('form.warehouse_name_ar') }}">
            @error('name.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="warehouse_name_en" class="form-label required">
                {{ __('form.warehouse_name_en') }}
            </label>
            <input type="text" name="name[en]" id="warehouse_name_en" class="form-control @error('name.en') is-invalid @enderror" 
            value="{{old('name.en',$warehouse->translations->where('locale', 'en')->first()->name ?? '')}}" 
            placeholder="{{ __('form.warehouse_name_en') }}">
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
            <label for="warehouse_description_ar" class="form-label">
                {{ __('form.description_ar') }}
            </label>
            <textarea class="form-control bg-light-subtle" name="description[ar]" id="warehouse_description_ar" placeholder="{{ __('form.description_ar') }}">{{ old('description.ar', $warehouse->translations->where('locale', 'ar')->first()->description ?? '') }}</textarea>
            @error('description.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="warehouse_description_en" class="form-label">
                {{ __('form.description_en') }}
            </label>
            <textarea class="form-control bg-light-subtle" name="description[en]" id="warehouse_description_en" placeholder="{{ __('form.description_en') }}">{{ old('description.en', $warehouse->translations->where('locale', 'en')->first()->description ?? '') }}</textarea>
            @error('description.en')
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
            <label for="warehouse_phone" class="form-label required">
                {{ __('form.warehouse_phone') }}
            </label>
            <input type="text" name="phone" id="warehouse_phone" class="form-control @error('phone') is-invalid @enderror" 
            value="{{old('phone',$warehouse->phone ?? '')}}" 
            placeholder="{{ __('form.warehouse_phone') }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="warehouse_street_details" class="form-label">
                {{ __('form.warehouse_street_details') }}
            </label>
            <input type="text" name="street_details" id="warehouse_street_details" class="form-control @error('street_details') is-invalid @enderror" 
            value="{{old('street_details',$warehouse->street_details ?? '')}}" 
            placeholder="{{ __('form.warehouse_street_details') }}">
             @error('street_details')
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
            <label for="choices_country_id" class="form-label required">
                {{__('form.country')}}
            </label>
            <select class="form-control" id="choices_country_id" name="country_id" data-choices data-choices-sorting-false>
                @if(old('country_id') == null)
                    <option value="" selected disabled>
                        {{__('form.select_country')}}
                    </option>
                @endif
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('country_id', $warehouse->country_id ?? '') == $country->id ? 'selected' : '' }}>
                            {{ $country->currentTranslation->name }}
                    </option>
                @endforeach
            </select>
            @error('country_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

   <div class="col-lg-6">
        <div class="mb-3">
            <label for="city_id" class="form-label required">{{__('form.city')}}</label>
            <div id="city_select_container">
                <select class="form-control" id="city_id" name="city_id" data-choices-city>
                    <option value="" selected disabled>{{__('form.select_city')}}</option>
                </select>
            </div>
            @error('city_id')
                <div class="invalid-feedback d-block"> {{$message}}
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
                @checked(old('status', $warehouse->status?->value) === Status::ACTIVE->value)>
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
<script>
    const selectCity = "{{__('form.select_city')}}";      
    const  CityId = "{{ old('city_id', $warehouse->city_id ?? '') }}";
</script>