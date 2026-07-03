<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="{{ app()->getLocale() }}">

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>{{ __('global.sign_in') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully responsive premium admin dashboard template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('assets/css/dashboard/vendor/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('assets/css/dashboard/vendor/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="{{ asset('assets/css/dashboard/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('assets/js/dashboard/vendor/config.js') }}"></script>
</head>

<body class="h-100">
    <div class="d-flex flex-column h-100 p-3">
        <div class="d-flex flex-column flex-grow-1">
            <div class="d-flex justify-content-end mb-2">
                @if (app()->getLocale() == 'ar')
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
                        <iconify-icon icon="circle-flags:us" class="fs-16"></iconify-icon> 
                        {{ __('dashboard.english') }}
                    </a>
                @else
                    <a href="{{ route('lang.switch', 'ar') }}"
                        class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
                        <iconify-icon icon="circle-flags:eg" class="fs-16"></iconify-icon> 
                        {{ __('dashboard.arabic') }}
                    </a>
                @endif
            </div>

            <div class="row h-100">
                <div class="col-xxl-7">
                    <div class="row justify-content-center h-100">
                        <div class="col-lg-6 py-lg-5">
                            <div class="d-flex flex-column h-100 justify-content-center">
                                <div class="auth-logo mb-4">
                                    <a href="index-2.html" class="logo-dark">
                                        <img src="{{ asset('assets/images/dashboard/logo-dark.png') }}" height="24"
                                            loading="lazy" alt="logo dark">
                                    </a>

                                    <a href="index-2.html" class="logo-light">
                                        <img src="{{ asset('assets/images/dashboard/logo-light.png') }}" height="24"
                                            loading="lazy" alt="logo light">
                                    </a>
                                </div>

                                <h2 class="fw-bold fs-24">
                                    {{ __('global.sign_in') }}
                                </h2>

                                <p class="text-muted mt-1 mb-4">
                                    {{ __('global.auth_text_note') }}
                                </p>
                                @error('login_failed')
                                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center gap-2" role="alert" style="background-color: #fce8e6; color: #a8201a;">
                                        <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-22 text-danger"></iconify-icon>
                                        
                                        <div class="flex-grow-1 fw-semibold fs-14">
                                            {{ $message }}
                                        </div>
                                        
                                        <button type="button" class="btn-close fs-12 mb-0" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @enderror
                                <div class="mb-5">
                                    <form action="{{ route('dashboard.v1.login.action') }}" method="POST"
                                        class="authentication-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="login">
                                                {{ __('global.login_label') }}
                                            </label>
                                            <input type="text" id="login" name="login"
                                                class="form-control 
                                                       @error('login')
                                                            is-invalid
                                                       @enderror"
                                                placeholder="{{ __('global.login_input_placeholder') }}">
                                            @error('login')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password">
                                                {{ __('global.password_label') }}
                                            </label>
                                            <input type="password" id="password" name="password"
                                                class="form-control 
                                                       @error('password') is-invalid @enderror"
                                                placeholder="{{ __('global.password_input_placeholder') }}">
                                            @error('password')
                                                <div id="validationServer03Feedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                <label class="form-check-label" for="checkbox-signin">
                                                    {{ __('global.remember_me_text') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-1 text-center d-grid">
                                            <button class="btn btn-soft-primary" type="submit">
                                                {{ __('global.sign_in') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-5 d-none d-xxl-flex">
                    <div class="card h-100 mb-0 overflow-hidden">
                        <div class="d-flex flex-column h-100">
                            <img src="{{ asset('assets/images/dashboard/small/img-10.jpg') }}" 
                            loading="lazy" alt="Cover"  
                                class="w-100 h-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('assets/js/dashboard/vendor/vendor.js') }}"></script>
    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset('assets/js/dashboard/app.js') }}"></script>
    @if (session('error'))
        <script>
            Swal.fire({
                title: "{{ __('dashboard.error') }} ❌",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonClass: "btn btn-primary w-xs mt-2",
                buttonsStyling: false,
                showCloseButton: true
            });
        </script>
    @endif

</body>

</html>
