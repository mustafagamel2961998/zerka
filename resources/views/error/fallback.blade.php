<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="{{ app()->getLocale() }}">
<head>
     <meta charset="utf-8" />
     <title>{{ __('global.fallback_error_msg') }} | {{ config('app.name') }}</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />

     <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

     <link href="{{ asset('assets/css/dashboard/vendor/vendor.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/dashboard/vendor/icons.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/dashboard/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="h-100 d-flex align-items-center justify-content-center bg-light-subtle">

     <div class="container">
          <div class="row justify-content-center">
               <div class="col-xl-6 col-lg-8 text-center">
                    <div class="card p-4 p-sm-5 shadow-sm border-0 rounded-3">
                         
                         <div class="mb-4 text-danger">
                              <iconify-icon icon="solar:danger-triangle-bold-duotone" class="display-1 text-danger animate-pulse"></iconify-icon>
                         </div>

                         <h1 class="fw-bold text-dark mb-2 fs-32">
                              {{ __('global.oops') }}
                         </h1>

                         <p class="text-muted fs-16 mb-4">
                              @if(session('error'))
                                   {{ session('error') }}
                              @elseif(isset($message))
                                   {{ $message }}
                              @else
                                   {{ __('global.fallback_error_msg') }}
                              @endif
                         </p>

                         <div class="d-flex flex-wrap justify-content-center gap-2">
                              <a href="" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
                                   <iconify-icon icon="solar:home-smile-angle-outline" class="fs-18"></iconify-icon>
                                   {{ __('global.back_to_home') }}
                              </a>
                         </div>

                         @if(config('app.debug') && isset($exception))
                              <div class="mt-4 text-start bg-dark text-danger p-3 rounded-2 text-wrap" style="font-family: monospace; font-size: 12px; max-height: 200px; overflow-y: auto;">
                                   <strong>Debug Exception:</strong> 
                                   {{ $exception->getMessage() }}
                              </div>
                         @endif

                    </div>
                    
                    <p class="text-muted mt-4 fs-13">{{ date('Y') }} &copy; {{ config('app.name') }}.</p>
               </div>
          </div>
     </div>

     <script src="{{ asset('assets/js/dashboard/vendor/vendor.js') }}"></script>
     <script src="{{ asset('assets/js/dashboard/app.js') }}"></script>

</body>
</html>