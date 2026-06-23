<div class="table-responsive">
    <table id="my-category-html-table" class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <th>{{ __('global.number') }}</th>
                <th>{{ __('global.cover') }}</th>
                <th>{{ __('global.category_name') }}</th>
                <th>{{ __('global.description') }}</th>
                <th>{{ __('global.category_parent') }}</th>
                <th>{{ __('global.sub_categories_count') }}</th>
                <th>{{ __('global.seo') }}</th>
                <th>{{ __('global.created_at') }}</th>
                <th>{{ __('global.status') }}</th>
                <th>{{ __('global.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                     <td>
                        {{ $loop->iteration}}
                    </td>
                    <td>
                        <x-dashboard.partial.image :src="$category->getFirstMediaUrl('cover', 'thumb')" :alt="$category->currentTranslation->name"/>
                    </td>
                    <td>
                        {{ $category->currentTranslation->name }}
                    </td>
                    <td>
                         {{ $category->currentTranslation->description }}
                    </td>

                    <td>
                        {{ $category->parent?->currentTranslation->name }}
                    </td>
                    <td>
                        {{ $category->children_count }}
                    </td>
                   <td>
                        <button type="button" 
                            class="btn btn-soft-info btn-sm open-seo-modal" 
                            data-title="{{ $category->currentTranslation->meta_title ?? __('global.not_found') }}" 
                            data-desc="{{ $category->currentTranslation->meta_description ?? __('global.not_found') }}"
                            data-category="{{ $category->currentTranslation->name }}">
                        <iconify-icon icon="solar:globus-broken" class="align-middle fs-18 me-1"></iconify-icon>
                        {{ __('global.seo') }}
                    </button>
                   </td>
                   <td>
                        {{ $category->created_at->translatedFormat('Y-m-d') }} /
                        <small class="text-muted">({{ $category->created_at->diffForHumans() }})</small>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" role="switch" @checked($category->status->value === 'active')>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="#!" class="btn btn-light btn-sm">
                                <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                            </a>
                            <a href="{{route('dashboard.v1.categories.edit', $category->id)}}" class="btn btn-soft-primary btn-sm">
                                <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                            </a>
                            <button type="button" class="btn btn-soft-danger btn-sm open-delete-modal"
                                    data-url="{{route('dashboard.v1.categories.destroy', $category->id)}}" 
                                    data-name="{{$category->currentTranslation->name}}">
                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                            </button>
                            
                        </div>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>

<div id="table-category-gridjs"></div>
{{-- delete modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            
            <div class="modal-body text-center p-4">
                
                <div class="d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle mb-3" style="width: 64px; height: 64px;">
                    <iconify-icon icon="solar:danger-triangle-bold-duotone" style="font-size: 36px;"></iconify-icon>
                </div>

                <h4 class="text-dark fw-bold mb-2">{{ __('global.delete_confirmation') }}</h4>
                
                <p class="text-muted fs-15 mb-3">
                    {{ __('global.delete_warning_title', ['name' => __('dashboard.category')]) }}
                    <strong id="name-span" class="text-dark fw-semibold d-block mt-1 fs-16"></strong>
                </p>

                <p class="text-secondary small mb-0 fs-12">
                    <iconify-icon icon="solar:lock-password-broken" class="align-middle me-1"></iconify-icon>
                    {{ __('global.cannot_undo') }}
                </p>
            </div>

            <div class="modal-footer border-0 bg-light-subtle d-flex justify-content-center gap-2 pb-4 pt-0 px-4">
                <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                    {{ __('global.cancel') }}
                </button>
                
                <form id="modal-delete-form" action="" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger fw-medium px-4" style="border-radius: 8px;">
                        {{ __('global.confirm_delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- seo poup modal --}}
<div class="modal fade" id="seoModal" tabindex="-1" aria-labelledby="seoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            
            <!-- Modal Header -->
            <div class="modal-header bg-light-subtle border-0 py-3 px-4 d-flex align-items-center justify-content-between">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="seoModalLabel">
                    <iconify-icon icon="solar:bill-list-bold-duotone" class="text-info fs-24"></iconify-icon>
                    <span><span id="seo-category-name" class="text-muted small fw-normal"></span></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <!-- Meta Title -->
                <div class="mb-4">
                    <label class="form-label fw-semibold text-dark fs-14 mb-2 d-flex align-items-center gap-1">
                        <iconify-icon icon="solar:text-bold-broken" class="text-muted fs-18"></iconify-icon>
                        {{ __('global.meta_title') }}
                    </label>
                    <div class="p-3 bg-light rounded-3 border">
                        <p id="seo-meta-title" class="mb-0 text-secondary fs-14 fw-medium"></p>
                    </div>
                </div>

                <!-- Meta Description -->
                <div class="mb-0">
                    <label class="form-label fw-semibold text-dark fs-14 mb-2 d-flex align-items-center gap-1">
                        <iconify-icon icon="solar:notes-broken" class="text-muted fs-18"></iconify-icon>
                        {{ __('global.meta_description') }}
                    </label>
                    <div class="p-3 bg-light rounded-3 border">
                        <p id="seo-meta-desc" class="mb-0 text-secondary fs-14" style="white-space: pre-line; line-height: 1.6;"></p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer border-0 bg-light-subtle d-flex justify-content-end py-3 px-4">
                <button type="button" class="btn btn-light fw-medium px-4" data-bs-dismiss="modal" style="border-radius: 8px;">
                    {{ __('global.close')}}
                </button>
            </div>
        </div>
    </div>
</div>

