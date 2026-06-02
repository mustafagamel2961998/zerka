<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="{{ app()->getLocale() }}">
<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Sign In | Larkon - Responsive Admin Dashboard Template</title>
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
               <div class="row h-100">
                    <div class="col-xxl-7">
                         <div class="row justify-content-center h-100">
                              <div class="col-lg-6 py-lg-5">
                                   <div class="d-flex flex-column h-100 justify-content-center">
                                        <div class="auth-logo mb-4">
                                             <a href="index-2.html" class="logo-dark">
                                                  <img src="{{ asset('assets/images/dashboard/logo-dark.png') }}" height="24" alt="logo dark">
                                             </a>

                                             <a href="index-2.html" class="logo-light">
                                                  <img src="{{ asset('assets/images/dashboard/logo-light.png') }}" height="24" alt="logo light">
                                             </a>
                                        </div>

                                        <h2 class="fw-bold fs-24">Sign In</h2>

                                        <p class="text-muted mt-1 mb-4">Enter your email address and password to access admin panel.</p>

                                        <div class="mb-5">
                                             <form action="{{ route('v1.dashboard.login') }}" method="POST" class="authentication-form">
                                                @csrf
                                                  <div class="mb-3">
                                                       <label class="form-label" for="example-email">Email</label>
                                                       <input type="email" id="email" name="email" class="form-control 
                                                       @error('email')
                                                            is-invalid
                                                       @enderror" 
                                                       placeholder="{{ __('dashboard.email_input_placeholder') }}">
                                                       @error('email') 
                                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                       @enderror
                                                  </div>
                                                  <div class="mb-3">
                                                       <label class="form-label" for="example-password">Password</label>
                                                       <input type="text" id="example-password" class="form-control 
                                                       @error('password') is-invalid @enderror" 
                                                       placeholder="{{ __('dashboard.password_input_placeholder') }}">
                                                        @error('password') 
                                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                                {{$message}}
                                                            </div>
                                                        @enderror
                                                       
                                                  </div>
                                                  <div class="mb-3">
                                                       <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                            <label class="form-check-label" for="checkbox-signin">
                                                                 {{ __('dashboard.remember_me_text') }}
                                                            </label>
                                                       </div>
                                                  </div>

                                                  <div class="mb-1 text-center d-grid">
                                                       <button class="btn btn-soft-primary" type="submit">Sign In</button>
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
                                   <img src="{{ asset('assets/images/dashboard/small/img-10.jpg') }}" alt="" class="w-100 h-100">
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
                    title: "{{ __('user.error') }} ❌",
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