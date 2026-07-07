@php
    use App\Enums\Status;
@endphp

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-transparent border-bottom py-3">
                <h4 class="card-title mb-0">
                    {{__('form.add_cover_photo')}}    
                </h4>
            </div>
            <div class="card-body">
                <label for="category_cover" class="custom-dropzone d-flex flex-column align-items-center justify-content-center border-dashed p-4 text-center rounded-3 position-relative">
                    
                  <input type="file" name="cover" id="category_cover" class="d-none @error('cover') is-invalid @enderror" accept="image/*">
                    
                   <div id="dropzone_upload_msg" class="{{ $category->hasMedia('cover') ? 'd-none' : '' }}">
                        <i class="bx bx-cloud-upload text-primary mb-2" style="font-size: 48px;"></i>
                        
                        <h3 class="mt-2 fs-5 fw-semibold">
                            {{ __('form.drop_image_here') }} 
                            <span class="text-primary">{{ __('form.click_to_browse') }}</span>
                        </h3>
                        
                        <span class="text-muted small">
                            {{ __('form.only_one_image_allowed') }}
                        </span>
                    </div>

                    <div id="preview_container" class="{{ $category->hasMedia('cover') ? '' : 'd-none' }} position-relative">
                        <img id="cover_preview" 
                            src="{{ $category->getFirstMediaUrl('cover', 'thumb') }}" 
                            alt="Cover Preview" 
                            class="category_cover rounded shadow-sm img-thumbnail animate-fade-in">
                        
                        <div class="mt-2 text-primary small fw-semibold">
                            <i class="bx bx-refresh fs-5 align-middle"></i> {{ __('form.click_to_change_image') }}
                        </div>
                    </div>
                </label>

                @error('cover')
                    <div class="text-danger small mt-2 px-1">
                        <i class="bx bx-error-circle align-middle"></i> {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="category_name_ar" class="form-label required">
                {{ __('form.category_name_ar') }}
            </label>
            <input type="text" name="name[ar]" id="category_name_ar" class="form-control @error('name.ar') is-invalid @enderror" 
            value="{{old('name.ar',$category->translations->where('locale', 'ar')->first()->name ?? '')}}" 
            placeholder="{{ __('form.category_name_ar') }}">
            @error('name.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-lg-6">
        <div class="mb-3">
            <label for="category_name_en" class="form-label required">
                {{ __('form.category_name_en') }}
            </label>
            <input type="text" name="name[en]" id="category_name_en" class="form-control @error('name.en') is-invalid @enderror" 
            value="{{old('name.en',$category->translations->where('locale', 'en')->first()->name ?? '')}}" 
            placeholder="{{ __('form.category_name_en') }}">
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
            <label for="category_description_ar" class="form-label">
                {{ __('form.description_ar') }}
            </label>
            <textarea class="form-control bg-light-subtle" name="description[ar]" id="category_description_ar" placeholder="{{ __('form.description_ar') }}">{{ old('description.ar', $category->translations->where('locale', 'ar')->first()->description ?? '') }}</textarea>
            @error('description.ar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="category_description_en" class="form-label">
                {{ __('form.description_en') }}
            </label>
            <textarea class="form-control bg-light-subtle" name="description[en]" id="category_description_en" placeholder="{{ __('form.description_en') }}">{{ old('description.en', $category->translations->where('locale', 'en')->first()->description ?? '') }}</textarea>
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
            <label for="choices_parent_id" class="form-label required">
                {{__('form.category_parent')}}
            </label>
            <select class="form-control" id="choices_parent_id" name="parent_id" data-choices data-choices-sorting-false>
                @if(old('parent_id') == null)
                    <option value="" selected disabled>
                        {{__('form.category_parent')}}
                    </option>
                @endif
                @foreach($categories->where('id','<>', $category->id) as $item) 
                    <option value="{{ $item->id }}" {{ old('parent_id', $category->parent_id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->currentTranslation->name ?? $item->name }}
                    </option>
                @endforeach
            </select>
            @error('parent_id')
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
                @checked(old('status',$category->status?->value) === Status::ACTIVE->value)>
                @error('status')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-3">
            
            <div class="form-check form-switch">
                <label for="is_menu" class="form-label required">{{ __('form.is_menu') }}</label>
                <input class="form-check-input" type="checkbox" id="is_menu" name="is_menu" role="switch"
                @checked(old('is_menu',$category->is_menu))>
                @error('is_menu')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    
</div>

<div class="row mb-4">
                 
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3 border-start border-primary border-3">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <div class="card-header bg-transparent border-bottom py-3">
                            <h4 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                {{ __('form.seo_settings') }}
                                </button>
                            </h4>
                        </div>
                     
                        <div id="collapseOne" class="accordion-collapse collapse  
                            @if($category->hasSeoData()) show @endif
                            {{ $errors->hasAny(['meta_title.ar', 'meta_title.en', 'meta_description.ar', 'meta_description.en']) ? 'show' : '' }}"  
                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card-body">
                                    
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="meta_title_ar" class="form-label fw-semibold text-dark">{{ __('form.meta_title_ar') }}</label>
                                                <input type="text" name="meta_title[ar]" id="meta_title_ar" class="form-control @error('meta_title.ar') is-invalid @enderror" 
                                                    value="{{ old('meta_title.ar', $category->translations?->where('locale', 'ar')->first()->meta_title ?? '') }}"
                                                    placeholder="{{ __('form.meta_title_ar_placeholder') }}">
                                                <div class="form-text text-muted fs-12">{{ __('form.meta_title_ar_hint') }}</div>
                                                @error('meta_title.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="meta_title_en" class="form-label fw-semibold text-dark">{{ __('form.meta_title_en') }}</label>
                                                <input type="text" name="meta_title[en]" id="meta_title_en" class="form-control @error('meta_title.en') is-invalid @enderror" 
                                                    value="{{ old('meta_title.en', $category->translations?->where('locale', 'en')->first()->meta_title ?? '') }}"
                                                    placeholder="{{ __('form.meta_title_en_placeholder') }}">
                                                <div class="form-text text-muted fs-12">{{ __('form.meta_title_en_hint') }}</div>
                                                @error('meta_title.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="meta_description_ar" class="form-label fw-semibold text-dark">{{ __('form.meta_description_ar') }}</label>
                                                <textarea name="meta_description[ar]" id="meta_description_ar" class="form-control bg-light-subtle @error('meta_description.ar') is-invalid @enderror" rows="3"
                                                        placeholder="{{ __('form.meta_description_ar_placeholder') }}">{{ old('meta_description.ar', $category->translations?->where('locale', 'ar')->first()->meta_description ?? '') }}</textarea>
                                                <div class="form-text text-muted fs-12">{{ __('form.meta_description_ar_hint') }}</div>
                                                @error('meta_description.ar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label for="meta_description_en" class="form-label fw-semibold text-dark">{{ __('form.meta_description_en') }}</label>
                                                <textarea name="meta_description[en]" id="meta_description_en" class="form-control bg-light-subtle @error('meta_description.en') is-invalid @enderror" rows="3"
                                                        placeholder="{{ __('form.meta_description_en_placeholder') }}">{{ old('meta_description.en', $category->translations?->where('locale', 'en')->first()->meta_description ?? '') }}</textarea>
                                                <div class="form-text text-muted fs-12">{{ __('form.meta_description_en_hint') }}</div>
                                                @error('meta_description.en') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>




<div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
            <button type="submit" class="btn btn-primary px-4">
                {{ $btn_text }}
            </button>
        </div>
   </div>
</div>
