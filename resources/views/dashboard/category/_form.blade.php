 @php
     use App\Enums\Status;
 @endphp
 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="city_name_ar" class="form-label required">
                {{ __('form.city_name_ar') }}
            </label>
            <input type="text" name="name[ar]" id="city_name_ar" class="form-control @error('name.ar') is-invalid @enderror" 
            value="{{old('name.ar',$city->translations->where('locale', 'ar')->first()->name ?? '')}}" 
            placeholder="{{ __('form.city_name_ar') }}">
            @error('name.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="city_name_en" class="form-label required">
                {{ __('form.city_name_en') }}
            </label>
            <input type="text" name="name[en]" id="city_name_en" class="form-control @error('name.en') is-invalid @enderror" 
            value="{{old('name.en',$city->translations->where('locale', 'en')->first()->name ?? '')}}" 
            placeholder="{{ __('form.city_name_en') }}">
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
                    <option value="{{ $country->id }}" {{ old('country_id', $city->country_id ?? '') == $country->id ? 'selected' : '' }}>
                            {{ $country->translation->name }}
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

</div>
<div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            
            <div class="form-check form-switch">
                <label for="status" class="form-label required">{{ __('form.status') }}</label>
              
                <input class="form-check-input" type="checkbox" id="status" name="status" role="switch"
                @checked(old('status', $city->status) === Status::ACTIVE)>
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
