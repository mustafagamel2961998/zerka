@php
    use App\Enums\Status;
@endphp

<div class="row">
    @if(isset($product->id))
        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <!-- صورة المعاينة الجانبية -->
                    <img src="{{$product->getFirstMediaUrl('images','optimized')}}" alt="" class="img-fluid rounded bg-light">

                    <div class="mt-3">
                        <h4>
                            {{ $product->currentTranslation->name }}
                            <span class="fs-14 text-muted ms-1">({{$product->category->currentTranslation->name}})</span></h4>

                        {{-- <h5 class="text-dark fw-medium mt-3">Price :</h5>
                        <h4 class="fw-semibold text-dark mt-2 d-flex align-items-center gap-2">
                            <span class="text-muted text-decoration-line-through">$100</span> $80 <small class="text-muted">
                                (30% Off)
                            </small>
                        </h4> --}}
                        <!-- معاينة المقاسات -->
                        <div class="mt-3">
                            <h5 class="text-dark fw-medium">{{__('global.sizes')}} :</h5>
                            <div class="d-flex flex-wrap gap-2" role="group"
                                aria-label="Basic checkbox toggle button group">
                                @foreach ($product->variants as $variant)
                                <label class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center"
                                    for="size-s">
                                    {{ $variant->size->size }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- معاينة الألوان -->
                        <div class="mt-3">
                            <h5 class="text-dark fw-medium">{{__('global.colors')}} :</h5>
                            <div class="d-flex flex-wrap gap-2" role="group"
                                aria-label="Basic checkbox toggle button group">
                                 @foreach ($product->variants as $variant)
                               <label
                                    class="color-preview-circle border shadow-sm"
                                    for="color-dark"
                                    style="
                                        display: inline-block;
                                        width: 22px;
                                        height: 22px;
                                        background-color: {{$variant->color->code}};
                                        border-radius: 50%;
                                        flex-shrink: 0;
                                        cursor: pointer;
                                    ">
                                </label>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="@if(isset($product->id)) col-xl-9 col-lg-8 @else col-xl-12 col-lg-12 @endif">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">
                    {{ __('form.add_product_photos') }}
                </h4>
            </div>
            <div class="card-body">
                <label for="product_images"
                    class="custom-dropzone d-flex flex-column align-items-center justify-content-center border-dashed p-4 text-center rounded-3 position-relative"
                    style="cursor: pointer; border: 2px dashed #dee2e6;">

                    <input type="file" name="images[]" id="product_images"
                        class="d-none @error('images') is-invalid @enderror" accept="image/*" multiple>

                    <div id="dropzone_upload_msg" class="{{ $product->hasMedia('images') ? 'd-none' : '' }} py-3">
                        <i class="bx bx-cloud-upload text-primary mb-2" style="font-size: 48px;"></i>
                        <h3 class="mt-2 fs-5 fw-semibold">
                            {{ __('form.drop_images_here') }}
                            <span class="text-primary">{{ __('form.click_to_browse') }}</span>
                        </h3>
                        <span class="text-muted small">
                            {{ __('form.multiple_images_allowed') }}
                        </span>
                    </div>

                    <div id="preview_container" class="{{ $product->hasMedia('images') ? '' : 'd-none' }} w-100">

                        <div class="row g-2 justify-content-start images-grid-row">

                            @if ($product->hasMedia('images'))
                                @foreach ($product->getMedia('images') as $media)
                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3 server-preview">
                                        <div class="position-relative product-img-wrap shadow-sm rounded border border-light"
                                            style="overflow: hidden;">
                                            <img src="{{ $media->getUrl() }}" alt="Product Image"
                                                class="w-100"
                                                style="height: 110px; object-fit: cover; display: block;">

                                            <span class="badge bg-success position-absolute bottom-0 start-0 m-1 fs-10"
                                                style="z-index: 4;">Saved</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="mt-2 text-primary small fw-semibold text-center w-100">
                            <i class="bx bx-refresh fs-5 align-middle"></i>
                            {{ __('form.click_to_add_or_change_images') }}
                        </div>
                    </div>
                </label>

                @error('images')
                    <div class="text-danger small mt-2 px-1">
                        <i class="bx bx-error-circle align-middle"></i> {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- كارت معلومات المنتج الرئيسي -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{ __('form.product_details') }}
                </h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="product_name_ar" class="form-label required">
                                {{ __('form.product_name_ar') }}
                            </label>
                            <input type="text" name="name[ar]" id="product_name_ar"
                                class="form-control @error('name.ar') is-invalid @enderror"
                                value="{{ old('name.ar', $product->translations->where('locale', 'ar')->first()->name ?? '') }}"
                                placeholder="{{ __('form.product_name_ar') }}">
                            @error('name.ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="product_name_en" class="form-label required">
                                {{ __('form.product_name_en') }}
                            </label>
                            <input type="text" name="name[en]" id="product_name_en"
                                class="form-control @error('name.en') is-invalid @enderror"
                                value="{{ old('name.en', $product->translations->where('locale', 'en')->first()->name ?? '') }}"
                                placeholder="{{ __('form.product_name_en') }}">
                            @error('name.en')
                                <div class="invalid-feedback">{{ $message }}</div>
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
                            <textarea class="form-control bg-light-subtle" name="description[ar]" id="short_description_ar" rows="4"
                                placeholder="{{ __('form.short_description_ar') }}">{{ old('description.ar', $product->translations->where('locale', 'ar')->first()->description ?? '') }}</textarea>
                            @error('description.ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="short_description_en" class="form-label">
                                {{ __('form.short_description_en') }}
                            </label>
                            <textarea class="form-control bg-light-subtle" name="description[en]" id="short_description_en" rows="4"
                                placeholder="{{ __('form.short_description_en') }}">{{ old('description.en', $product->translations->where('locale', 'en')->first()->description ?? '') }}</textarea>
                            @error('description.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="long_description_ar" class="form-label">
                                {{ __('form.long_description_ar') }}
                            </label>
                            <textarea class="form-control bg-light-subtle" name="long_description[ar]" id="long_description_ar" rows="6"
                                placeholder="{{ __('form.long_description_ar') }}">{{ old('long_description.ar', $product->translations->where('locale', 'ar')->first()->long_description ?? '') }}</textarea>
                            @error('description.ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="long_description_en" class="form-label">
                                {{ __('form.long_description_en') }}
                            </label>
                            <textarea class="form-control bg-light-subtle" name="long_description[en]" id="long_description_en" rows="6"
                                placeholder="{{ __('form.long_description_en') }}">{{ old('long_description.en', $product->translations->where('locale', 'en')->first()->long_description ?? '') }}</textarea>
                            @error('long_description.en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{ __('form.product_specifications') }}
                </h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="select_category_id" class="form-label required">
                                {{ __('form.select_category_id') }}
                            </label>
                            <select class="form-control" id="select_category_id" name="category_id" data-choices
                                data-choices-sorting-false>
                                @if (old('category_id') == null)
                                    <option value="" selected disabled>
                                        {{ __('form.select_category_id') }}
                                    </option>
                                @endif
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->currentTranslation->name ?? $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>




                </div>


            </div>
        </div>







<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">{{ __('form.product_variants') }}</h4>
        <button type="button" class="btn btn-primary btn-sm" id="add-variant-btn">
            <i class="bx bx-plus"></i> {{ __('form.add_variant') }}
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-centered mb-0" id="variants-table">
                <thead>
                    <tr>
                        <th style="width: 15%;">{{ __('form.size') }}</th>
                        <th style="width: 22%;">{{ __('form.color') }}</th> 
                        <th style="width: 20%;">{{ __('form.warehouse') }}</th>
                        <th style="width: 15%;">{{ __('form.price') }}</th>
                        <th style="width: 12%;">{{ __('form.quantity') }}</th>
                        <th style="width: 11%;">{{ __('form.minimum_quantity') }}</th> 
                        <th style="width: 5%;">{{ __('form.action') }}</th>
                    </tr>
                </thead>
                <tbody id="variants-body">
                    {{-- 1. حالة وجود خطأ رجوع من الـ Validation (Old Values) --}}
                    @if(old('variants'))
                        @foreach(old('variants') as $index => $oldVariant)
                            <tr class="variant-row">
                                <td>
                                    <select name="variants[{{ $index }}][size_id]" class="form-control @error("variants.$index.size_id") is-invalid @enderror" required>
                                        @foreach($sizes as $size)
                                            <option value="{{ $size->id }}" @selected($oldVariant['size_id'] == $size->id)>{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                    @error("variants.$index.size_id") <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="color-preview-circle border rounded-circle shadow-sm" style="width: 22px; height: 22px; display: inline-block; background-color: #000; flex-shrink: 0;"></span>
                                        <select name="variants[{{ $index }}][color_id]" class="form-control color-selector @error("variants.$index.color_id") is-invalid @enderror" required>
                                            @foreach($colors as $color)
                                                <option value="{{ $color->id }}" data-hex="{{ $color->code ?? '#000000' }}" @selected($oldVariant['color_id'] == $color->id)>
                                                    {{ $color->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error("variants.$index.color_id") <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </td>
                                <td>
                                    <select name="variants[{{ $index }}][warehouse_id]" class="form-control @error("variants.$index.warehouse_id") is-invalid @enderror" required>
                                        @foreach($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}" @selected($oldVariant['warehouse_id'] == $warehouse->id)>{{ $warehouse->currentTranslation->name ?? $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("variants.$index.warehouse_id") <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="variants[{{ $index }}][price]" class="form-control @error("variants.$index.price") is-invalid @enderror" step="0.01" value="{{ $oldVariant['price'] }}" required>
                                        @error("variants.$index.price") <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="variants[{{ $index }}][quantity]" class="form-control @error("variants.$index.quantity") is-invalid @enderror" value="{{ $oldVariant['quantity'] }}" required>
                                    @error("variants.$index.quantity") <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </td>
                                <td>
                                    <input type="number" name="variants[{{ $index }}][minimum_quantity]" class="form-control @error("variants.$index.minimum_quantity") is-invalid @enderror" value="{{ $oldVariant['minimum_quantity'] }}" required>
                                    @error("variants.$index.minimum_quantity") <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row d-flex align-items-center gap-1 justify-content-center mx-auto">
                                        <i class="bx bx-trash fs-14"></i><span>{{ __('form.delete') }}</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    @elseif(isset($product) && $product->variants->count() > 0)
                        @foreach($product->variants as $index => $variant)
                            <tr class="variant-row">
                                <td>
                                    <select name="variants[{{ $index }}][size_id]" class="form-control" required>
                                        @foreach($sizes as $size)
                                            <option value="{{ $size->id }}" @selected($variant->size_id == $size->id)>{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="color-preview-circle border rounded-circle shadow-sm" style="width: 22px; height: 22px; display: inline-block; background-color: #000; flex-shrink: 0;"></span>
                                        <select name="variants[{{ $index }}][color_id]" class="form-control color-selector" required>
                                            @foreach($colors as $color)
                                                <option value="{{ $color->id }}" data-hex="{{ $color->code ?? '#000000' }}" @selected($variant->color_id == $color->id)>
                                                    {{ $color->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <select name="variants[{{ $index }}][warehouse_id]" class="form-control" required>
                                        @foreach($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}" @selected($variant->inventory?->warehouse_id == $warehouse->id)>{{ $warehouse->currentTranslation->name ?? $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="variants[{{ $index }}][price]" class="form-control" step="0.01" value="{{ $variant->price }}" required>
                                    </div>
                                </td>
                                <td>
                                    <input type="number" name="variants[{{ $index }}][quantity]" class="form-control" value="{{ $variant->inventory?->quantity ?? 0 }}" required>
                                </td>
                                <td>
                                    <input type="number" name="variants[{{ $index }}][minimum_quantity]" class="form-control" value="{{ $variant->inventory?->minimum_quantity ?? 0 }}" required>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row d-flex align-items-center gap-1 justify-content-center mx-auto">
                                        <i class="bx bx-trash fs-14"></i><span>{{ __('form.delete') }}</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- القالب النظيف للاستخدام عند إضافة صف جديد --}}
<template id="variant-template">
    <tr class="variant-row">
        <td>
            <select name="variants[__index__][size_id]" class="form-control" required>
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <div class="d-flex align-items-center gap-2">
                <span class="color-preview-circle border rounded-circle shadow-sm" style="width: 22px; height: 22px; display: inline-block; background-color: #000; flex-shrink: 0;"></span>
                <select name="variants[__index__][color_id]" class="form-control color-selector" required>
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}" data-hex="{{ $color->code ?? '#000000' }}">
                            {{ $color->code }}
                        </option>
                    @endforeach
                </select>
            </div>
        </td>
        <td>
            <select name="variants[__index__][warehouse_id]" class="form-control" required>
                @foreach($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}">{{ $warehouse->currentTranslation->name ?? $warehouse->name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="variants[__index__][price]" class="form-control" step="0.01" placeholder="0.00" required>
            </div>
        </td>
        <td><input type="number" name="variants[__index__][quantity]" class="form-control" placeholder="0" required></td>
        <td><input type="number" name="variants[__index__][minimum_quantity]" class="form-control" placeholder="0" value="0" required></td>
        <td class="text-center align-middle">
            <button type="button" class="btn btn-sm btn-outline-danger remove-row d-flex align-items-center gap-1 justify-content-center mx-auto" style="white-space: nowrap;">
                <i class="bx bx-trash fs-14"></i><span>{{ __('form.delete') }}</span>
            </button>
        </td>
    </tr>
</template>












        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{ __('form.status') }}
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <label for="status"
                                    class="form-label required d-block mb-2">{{ __('form.status') }}</label>
                                <input class="form-check-input ms-0" type="checkbox" id="status" name="status"
                                    role="switch" @checked(old('status', $product->status?->value) === Status::ACTIVE->value)>
                                @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
                                    <button class="accordion-button fw-medium" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                        aria-controls="collapseOne">
                                        {{ __('form.seo_settings') }}
                                    </button>
                                </h4>
                            </div>

                            <div id="collapseOne"
                                class="accordion-collapse collapse  
                            @if ($product->hasSeoData()) show @endif
                            {{ $errors->hasAny(['meta_title.ar', 'meta_title.en', 'meta_description.ar', 'meta_description.en']) ? 'show' : '' }}"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="card-body">

                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="meta_title_ar"
                                                        class="form-label fw-semibold text-dark">{{ __('form.meta_title_ar') }}</label>
                                                    <input type="text" name="meta_title[ar]" id="meta_title_ar"
                                                        class="form-control @error('meta_title.ar') is-invalid @enderror"
                                                        value="{{ old('meta_title.ar', $product->currentTranslation?->where('locale', 'ar')->first()->meta_title ?? '') }}"
                                                        placeholder="{{ __('form.meta_title_ar_placeholder') }}">
                                                    <div class="form-text text-muted fs-12">
                                                        {{ __('form.meta_title_ar_hint') }}</div>
                                                    @error('meta_title.ar')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="meta_title_en"
                                                        class="form-label fw-semibold text-dark">{{ __('form.meta_title_en') }}</label>
                                                    <input type="text" name="meta_title[en]" id="meta_title_en"
                                                        class="form-control @error('meta_title.en') is-invalid @enderror"
                                                        value="{{ old('meta_title.en', $product->currentTranslation?->where('locale', 'en')->first()->meta_title ?? '') }}"
                                                        placeholder="{{ __('form.meta_title_en_placeholder') }}">
                                                    <div class="form-text text-muted fs-12">
                                                        {{ __('form.meta_title_en_hint') }}</div>
                                                    @error('meta_title.en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="meta_description_ar"
                                                        class="form-label fw-semibold text-dark">{{ __('form.meta_description_ar') }}</label>
                                                    <textarea name="meta_description[ar]" id="meta_description_ar"
                                                        class="form-control bg-light-subtle @error('meta_description.ar') is-invalid @enderror" rows="3"
                                                        placeholder="{{ __('form.meta_description_ar_placeholder') }}">{{ old('meta_description.ar', $product->currentTranslation?->where('locale', 'ar')->first()->meta_description ?? '') }}</textarea>
                                                    <div class="form-text text-muted fs-12">
                                                        {{ __('form.meta_description_ar_hint') }}</div>
                                                    @error('meta_description.ar')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-2">
                                                    <label for="meta_description_en"
                                                        class="form-label fw-semibold text-dark">{{ __('form.meta_description_en') }}</label>
                                                    <textarea name="meta_description[en]" id="meta_description_en"
                                                        class="form-control bg-light-subtle @error('meta_description.en') is-invalid @enderror" rows="3"
                                                        placeholder="{{ __('form.meta_description_en_placeholder') }}">{{ old('meta_description.en', $product->currentTranslation?->where('locale', 'en')->first()->meta_description ?? '') }}</textarea>
                                                    <div class="form-text text-muted fs-12">
                                                        {{ __('form.meta_description_en_hint') }}</div>
                                                    @error('meta_description.en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                <div class="p-3 bg-light mb-3 rounded">
                    <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ $btn_text }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
