 @php
     use App\Enums\Status;
 @endphp
 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="code" class="form-label required">
                {{ __('form.color_code') }}
            </label>
            <input type="color" name="code" id="code" class="form-control @error('code') is-invalid @enderror" 
            value="{{old('code',$color->code)}}" 
            placeholder="{{ __('form.color_code') }}">
            @error('code')
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
                @checked(old('status', $color->status?->value) === Status::ACTIVE->value)>
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
