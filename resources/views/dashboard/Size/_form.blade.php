 @php
     use App\Enums\Status;
 @endphp
 <div class="row">

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="size" class="form-label required">
                {{ __('form.size') }}
            </label>
            <input type="color" name="size" id="size" class="form-control @error('size') is-invalid @enderror" 
            value="{{old('size',$size->size)}}" 
            placeholder="{{ __('form.size') }}">
            @error('size')
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
                @checked(old('status', $size->status) === Status::ACTIVE)>
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
