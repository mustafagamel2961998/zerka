 @php
     use App\Enums\Status;
 @endphp

 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="product_name_ar" class="form-label required">
                {{ __('form.product_name_ar') }}
            </label>
            <input type="text" name="name[ar]" id="product_name_ar" class="form-control @error('name.ar') is-invalid @enderror" 
            value="{{old('name.ar',$product->translations->where('locale', 'ar')->first()->name ?? '')}}" 
            placeholder="{{ __('form.product_name_ar') }}">
            @error('name.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="product_name_en" class="form-label required">
                {{ __('form.product_name_en') }}
            </label>
            <input type="text" name="name[en]" id="product_name_en" class="form-control @error('name.en') is-invalid @enderror" 
            value="{{old('name.en',$product->translations->where('locale', 'en')->first()->name ?? '')}}" 
            placeholder="{{ __('form.product_name_en') }}">
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
            <label for="short_description_ar" class="form-label">
                {{ __('form.short_description_ar') }}
            </label>
            <textarea class="form-control bg-light-subtle" name="description[ar]" id="short_description_ar" placeholder="{{ __('form.short_description_ar') }}">{{ old('description.ar', $product->translations->where('locale', 'ar')->first()->description ?? '') }}</textarea>
            @error('description.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="short_description_en" class="form-label">
                {{ __('form.short_description_en') }}
            </label>
            <textarea class="form-control bg-light-subtle" name="description[en]" id="short_description_en" placeholder="{{ __('form.short_description_en') }}">{{ old('description.en', $product->translations->where('locale', 'en')->first()->description ?? '') }}</textarea>
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
            <label for="long_description_ar" class="form-label">
                {{ __('form.long_description_ar') }}
            </label>
            <textarea class="form-control bg-light-subtle" name="long_description[ar]" id="long_description_ar" placeholder="{{ __('form.long_description_ar') }}">{{ old('long_description.ar', $product->translations->where('locale', 'ar')->first()->long_description ?? '') }}</textarea>
            @error('description.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="long_description_en" class="form-label">
                {{ __('form.long_description_en') }}
            </label>
            <textarea class="form-control bg-light-subtle" name="long_description[en]" id="long_description_en" placeholder="{{ __('form.long_description_en') }}">{{ old('long_description.en', $product->translations->where('locale', 'en')->first()->long_description ?? '') }}</textarea>
            @error('long_description.en')
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
                @checked(old('status', $product->status?->value) === Status::ACTIVE->value)>
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
