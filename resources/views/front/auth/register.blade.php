<x-front.layout title="{{ __('global.register') }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/auth/auth.css') }}">
        <style>
            /* للتأكيد على تناسق القوائم المنسدلة مع التصميم الحاد */
            .form-select {
                border-radius: 0px;
            }
            .form-select:focus {
                border-color: #000;
                box-shadow: none;
            }
        </style>
    @endpush

    <div class="container py-5 my-4">
        <div class="row justify-content-center">
            <!-- كبرنا الحجم قليلاً ليتسع للحقول الإضافية بشكل مريح (col-md-8 col-lg-6) -->
            <div class="col-12 col-md-8 col-lg-6">
                
                <!-- كارت إنشاء الحساب -->
                <div class="auth-card p-4 p-sm-5">
                    
                    <!-- رأس الصفحة -->
                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus text-dark fs-1 mb-2 d-block"></i>
                        <h4 class="fw-bold text-uppercase tracking-wider m-0" style="font-size: 1.25rem;">
                            {{ __('global.register') }}
                        </h4>
                        <p class="text-muted small mt-1">
                            {{ __('front.create_account_desc') ?? 'قم بملء البيانات التالية لإنشاء حسابك الجديد' }}
                        </p>
                    </div>

                    <!-- فورم تسجيل حساب جديد -->
                    <form action="{{ route('register.action') }}" method="POST" novalidate>
                        @csrf

                        <!-- صف الاسم الأول والاسم الأخير -->
                        <div class="row g-3 mb-3">
                            <!-- الاسم الأول -->
                            <div class="col-sm-6">
                                <label for="first_name" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                    {{ __('global.first_name')}}
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="first_name" id="first_name" 
                                        class="form-control rounded-0 border-start-1 @error('first_name') is-invalid @enderror" 
                                        placeholder="{{ __('global.first_name') }}" 
                                        value="{{ old('first_name') }}" required autofocus>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <!-- الاسم الأخير -->
                            <div class="col-sm-6">
                                <label for="last_name" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                    {{ __('global.last_name')}}
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="last_name" id="last_name" 
                                        class="form-control rounded-0 border-start-1 @error('last_name') is-invalid @enderror" 
                                        placeholder="{{ __('global.last_name') }}" 
                                        value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- حقل البريد الإلكتروني -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                {{ __('global.email')}}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" id="email" 
                                    class="form-control rounded-0 border-start-1 @error('email') is-invalid @enderror" 
                                    placeholder="name@example.com" 
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- حقل الهاتف -->
                        <div class="mb-3">
                            <label for="phone" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                {{ __('global.phone') ?? 'رقم الهاتف' }}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="tel" name="phone" id="phone" 
                                    class="form-control rounded-0 border-start-1 @error('phone') is-invalid @enderror" 
                                    placeholder="+201xxxxxxxxx" 
                                    value="{{ old('phone') }}" required>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- صف الدولة والمدينة -->
                        
                        <div class="row g-3 mb-3">
                        <div class="col-sm-6">

                            <!-- الدولة -->
                                <label for="country_id" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                    {{ __('global.country')}}
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                        <i class="bi bi-globe"></i>
                                    </span>
                                    <select name="country_id" id="country_id" class="form-select rounded-0 border-start-1 @error('country_id') is-invalid @enderror" required>
                                        <option value="" selected disabled>{{ __('global.select_country') }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                {{ $country->currentTranslation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                        </div>
                        <!-- المدينة -->
                        <div class="col-sm-6">
                            <label for="city_id" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                {{ __('global.city') ?? 'المدينة' }}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                    <i class="bi bi-geo-alt"></i>
                                </span>
                                <select name="city_id" id="city_id" class="form-select rounded-0 border-start-1 @error('city_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>{{ __('global.select_city') }}</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                            {{ $city->currentTranslation->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        </div>
                        <!-- حقل كلمة المرور -->
                        <div class="mb-3">
                            <label for="password" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                {{ __('global.password') }}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" id="password" 
                                    class="form-control rounded-0 border-start-1 @error('password') is-invalid @enderror" 
                                    placeholder="••••••••" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- حقل تأكيد كلمة المرور -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                {{ __('global.confirm_password')}}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                    class="form-control rounded-0 border-start-1" 
                                    placeholder="••••••••" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- زر إنشاء الحساب -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-black btn-sm py-2 text-uppercase fw-bold text-nowrap">
                                {{ __('global.register') }}
                            </button>
                        </div>

                        <!-- رابط العودة لتسجيل الدخول -->
                        <div class="text-center">
                            <p class="text-muted small mb-0">
                                {{ __('front.already_have_account') ?? 'لديك حساب بالفعل؟' }}
                                <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none ms-1">
                                    {{ __('global.sign_in') }}
                                    <i class="bi bi-arrow-right ms-1 small"></i>
                                </a>
                            </p>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</x-front.layout>