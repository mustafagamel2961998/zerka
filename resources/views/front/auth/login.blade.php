<x-front.layout title="{{ __('global.sign_in') }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/auth/auth.css') }}">
    @endpush

    <div class="container py-5 my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5">
                
                <!-- كارت تسجيل الدخول -->
                <div class="auth-card p-4 p-sm-5">
                    
                    <!-- رأس الصفحة (العنوان) -->
                    <div class="text-center mb-4">
                        <i class="bi bi-shield-lock text-dark fs-1 mb-2 d-block"></i>
                        <h4 class="fw-bold text-uppercase tracking-wider m-0" style="font-size: 1.25rem;">
                            {{ __('global.sign_in') }}
                        </h4>
                        <p class="text-muted small mt-1">
                            {{ __('front.welcome_back_desc') }}
                        </p>
                    </div>

                    <!-- فورم تسجيل الدخول -->
                    <form action="{{ route('login.action') }}" method="POST" novalidate>
                        @csrf

                        <!-- حقل البريد الإلكتروني -->
                        <div class="mb-3">
                            <label for="login" class="form-label text-uppercase fw-semibold small text-muted" style="letter-spacing: 0.5px;">
                                {{ __('global.login')}}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="login" name="login" id="login" 
                                    class="form-control rounded-0 border-start-1 @error('login') is-invalid @enderror" 
                                    placeholder="{{ __('global.login')}}" 
                                    value="{{ old('login') }}" required autofocus>
                                
                                @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- حقل كلمة المرور -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label text-uppercase fw-semibold small text-muted m-0" style="letter-spacing: 0.5px;">
                                    {{ __('global.password')}}
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-dark small text-decoration-underline" style="font-size: 0.75rem;">
                                        {{ __('global.forgot_password')}}
                                    </a>
                                @endif
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0 text-muted rounded-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" id="password" 
                                    class="form-control rounded-0 border-start-1 @error('password') is-invalid @enderror" 
                                    placeholder="••••••••" required autocomplete="current-password">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- تذكرني -->
                        <div class="mb-4 d-flex align-items-center">
                            <input class="form-check-input rounded-0 me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-out text-muted small user-select-none" for="remember">
                                {{ __('global.remember_me')}}
                            </label>
                        </div>

                        <!-- زر تسجيل الدخول -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-black btn-sm py-2 text-uppercase fw-bold text-nowrap">
                                {{ __('global.sign_in') }}
                            </button>
                        </div>

                        <!-- رابط إنشاء حساب جديد -->
                        <div class="text-center">
                            <p class="text-muted small mb-0">
                                {{ __('front.dont_have_account') }}
                                <a href="{{route('register')}}" class="text-dark fw-bold text-decoration-none ms-1">
                                    {{ __('global.register')}}
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