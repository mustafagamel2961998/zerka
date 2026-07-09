<x-dashboard.layout title="{{ __('dashboard.settings') }}">

    <div class="card rounded-0 border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('dashboard.v1.settings.update', $setting->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row align-items-center">
                    {{-- الـ Preview + حقل الرفع المخفي --}}
                    <div class="col-12 text-center">
                        <label for="logo" class="d-inline-block position-relative" style="cursor: pointer;">
                            <div class="border p-2 bg-light-subtle rounded d-flex align-items-center justify-content-center shadow-sm mx-auto"
                                style="width: 120px; height: 120px;">
                                <img id="logo_preview" src="{{ $setting->getFirstMediaUrl('logo', 'thumb') }}"
                                    alt="Logo Preview" class="img-fluid h-100 object-fit-contain">
                            </div>
                            <div class="small text-muted mt-2">
                                {{ __('form.logo') }}
                            </div>
                        </label>

                        <input type="file" name="logo" id="logo" accept="image/*"
                            class="d-none @error('logo') is-invalid @enderror">

                        @error('logo')
                            <div class="invalid-feedback d-block text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="setting_name_ar" class="form-label">
                                {{ __('form.site_name_ar') }}
                            </label>
                            <input type="text" name="name[ar]" id="setting_name_ar"
                                class="form-control @error('name.ar') is-invalid @enderror"
                                value="{{ old('name.ar', $setting->translations->where('locale', 'ar')->first()?->name) }}"
                                placeholder="{{ __('form.site_name_ar') }}">
                            @error('name.ar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="setting_name_en" class="form-label">
                                {{ __('form.site_name_en') }}
                            </label>
                            <input type="text" name="name[en]" id="setting_name_en"
                                class="form-control @error('name.en') is-invalid @enderror"
                                value="{{ old('name.en', $setting->translations->where('locale', 'en')->first()?->name) }}"
                                placeholder="{{ __('form.site_name_en') }}">
                            @error('name.en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                {{ __('form.email') }}
                            </label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $setting->email) }}" placeholder="{{ __('form.email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                {{ __('form.phone') }}
                            </label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $setting->phone) }}" placeholder="{{ __('form.phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="tax_percentage" class="form-label">
                                {{ __('form.tax_percentage') }} (%)
                            </label>
                            <input type="number" name="tax_percentage" id="tax_percentage"
                                class="form-control @error('tax_percentage') is-invalid @enderror"
                                value="{{ old('tax_percentage', $setting->tax_percentage) }}"
                                placeholder="{{ __('form.tax_percentage') }}">
                            @error('tax_percentage')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="shipping_amount" class="form-label">
                                {{ __('form.shipping_amount') }}
                            </label>
                            <input type="text" name="shipping_amount" id="shipping_amount"
                                class="form-control @error('shipping_amount') is-invalid @enderror"
                                value="{{ old('shipping_amount', number_format($setting->shipping_amount, 2)) }}"
                                placeholder="{{ __('form.shipping_amount') }}">
                            @error('shipping_amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="currency_id" class="form-label">
                                {{ __('form.default_currency') }}
                            </label>
                            <select name="currency_id" id="currency_id"
                                class="form-select @error('currency_id') is-invalid @enderror">
                                <option value="" disabled>{{ __('form.select_currency') }}</option>
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->id }}" @selected(old('currency_id', $setting->currency_id) == $currency->id)>
                                        {{ $currency->currentTranslation->name ?? $currency->code }}
                                    </option>
                                @endforeach
                            </select>
                            @error('currency_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="country_id" class="form-label">
                                {{ __('form.country') }}
                            </label>
                            <select name="country_id" id="country_id"
                                class="form-select @error('country_id') is-invalid @enderror">
                                <option value="" disabled>{{ __('form.select_currency') }}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id', $setting->country_id) == $country->id)>
                                        {{ $country->currentTranslation->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('form.save') }}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/setting/size.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/setting/size.js') }}"></script>
        <script>
            document.getElementById('logo').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('logo_preview').setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
</x-dashboard.layout>
