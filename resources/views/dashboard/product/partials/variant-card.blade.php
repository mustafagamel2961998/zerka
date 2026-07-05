<div class="variant-card card mb-3 border" data-variant-index="{{ $vIndex }}"
    data-color-index="{{ isset($existingColors) ? $existingColors->count() : count($oldColors ?? []) }}">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 bg-light">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <select name="variants[{{ $vIndex }}][size_id]" class="form-control form-control-sm variant-size-select"
                required style="width: 120px;">
                <option value="">{{ __('form.size') }}</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}" @selected($sizeId == $size->id)>{{ $size->size }}</option>
                @endforeach
            </select>
            <div class="input-group input-group-sm" style="width: 140px;">
                <span class="input-group-text">$</span>
                <input type="number" name="variants[{{ $vIndex }}][price]" class="form-control" step="0.01"
                    value="{{ $price }}" required>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-outline-danger remove-variant-btn">
            <i class="bx bx-trash"></i> {{ __('form.remove') }}
        </button>
    </div>

    <div class="card-body">
        <label class="form-label small text-muted mb-1">{{ __('form.colors') }} — {{ __('form.click_to_add') }}</label>
        <div class="d-flex flex-wrap gap-2 color-swatches-container mb-3">
            @php
                $usedColorIds = isset($existingColors)
                    ? $existingColors->pluck('color.id')->filter()->toArray()
                    : collect($oldColors ?? [])
                        ->pluck('color_id')
                        ->toArray();
            @endphp
            @foreach ($colors as $color)
                <div class="position-relative p-0 cursor-pointer d-flex align-items-center justify-content-center rounded-circle border shadow-sm swatch {{ in_array($color->id, $usedColorIds) ? 'swatch-disabled' : '' }}"
                    data-color-id="{{ $color->id }}" title="{{ $color->code }}"
                    style="width: 28px; height: 28px; background-color: {{ $color->code ?? '#000000' }};">
                </div>
            @endforeach
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-bordered mb-0 colors-table">
                <thead>
                    <tr>
                        <th style="width: 20%;">{{ __('form.color') }}</th>
                        <th style="width: 30%;">{{ __('form.warehouse') }}</th>
                        <th style="width: 20%;">{{ __('form.quantity') }}</th>
                        <th style="width: 20%;">{{ __('form.minimum_quantity') }}</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody class="colors-body">
                    @if (isset($existingColors))
                        @foreach ($existingColors as $cIndex => $variantColor)
                            @php $inv = $variantColor->inventory; @endphp
                            <tr class="color-row" data-color-id="{{ $variantColor->color->id ?? '' }}">
                                <td class="align-middle">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="color-preview rounded-circle border"
                                            style="width:20px;height:20px;display:inline-block;background-color: {{ $variantColor->color->code ?? '#000' }};"></span>
                                        <input type="hidden"
                                            name="variants[{{ $vIndex }}][colors][{{ $cIndex }}][color_id]"
                                            value="{{ $variantColor->color->id ?? '' }}">
                                    </div>
                                </td>
                                <td>
                                    <select
                                        name="variants[{{ $vIndex }}][colors][{{ $cIndex }}][warehouse_id]"
                                        class="form-control form-control-sm" required>
                                        <option value="">{{ __('form.warehouse') }}</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}" @selected($inv?->warehouse_id == $warehouse->id)>
                                                {{ $warehouse->currentTranslation->name ?? $warehouse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number"
                                        name="variants[{{ $vIndex }}][colors][{{ $cIndex }}][quantity]"
                                        class="form-control form-control-sm" value="{{ $inv?->quantity ?? 0 }}"
                                        required></td>
                                <td><input type="number"
                                        name="variants[{{ $vIndex }}][colors][{{ $cIndex }}][minimum_quantity]"
                                        class="form-control form-control-sm" value="{{ $inv?->minimum_quantity ?? 0 }}"
                                        required></td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-color-row"><i
                                            class="bx bx-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @elseif(!empty($oldColors))
                        @foreach ($oldColors as $cIndex => $oldColor)
                            <tr class="color-row" data-color-id="{{ $oldColor['color_id'] ?? '' }}">
                                <td class="align-middle">
                                    <div class="d-flex align-items-center gap-2">
                                        @php $colorObj = $colors->firstWhere('id', (int) ($oldColor['color_id'] ?? 0)); @endphp
                                        <span class="color-preview rounded-circle border"
                                            style="width:20px;height:20px;display:inline-block;background-color: {{ $colorObj->code ?? '#000' }};"></span>
                                        <input type="hidden"
                                            name="variants[{{ $vIndex }}][colors][{{ $cIndex }}][color_id]"
                                            value="{{ $oldColor['color_id'] ?? '' }}">
                                    </div>
                                </td>
                                <td>
                                    <select
                                        name="variants[{{ $vIndex }}][colors][{{ $cIndex }}][warehouse_id]"
                                        class="form-control form-control-sm" required>
                                        <option value="">{{ __('form.warehouse') }}</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}" @selected(($oldColor['warehouse_id'] ?? null) == $warehouse->id)>
                                                {{ $warehouse->currentTranslation->name ?? $warehouse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number"
                                        name="variants[{{ $vIndex }}][colors][{{ $cIndex }}][quantity]"
                                        class="form-control form-control-sm" value="{{ $oldColor['quantity'] ?? 0 }}"
                                        required></td>
                                <td><input type="number"
                                        name="variants[{{ $vIndex }}][colors][{{ $cIndex }}][minimum_quantity]"
                                        class="form-control form-control-sm"
                                        value="{{ $oldColor['minimum_quantity'] ?? 0 }}" required></td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-color-row"><i
                                            class="bx bx-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
