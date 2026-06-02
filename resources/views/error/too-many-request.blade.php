<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <title>{{ __('global.to_many_requests') }} | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/dashboard/vendor/vendor.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dashboard/vendor/icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/dashboard/app.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/dashboard/vendor/config.js') }}"></script>
</head>
<body class="h-100">
<div class="d-flex flex-column h-100 p-3 align-items-center justify-content-center">
    <div class="card p-5 text-center" style="max-width: 480px; width: 100%;">

        <div class="rounded-circle bg-warning bg-opacity-25 d-flex align-items-center justify-content-center mx-auto mb-4"
             style="width:72px; height:72px;">
            <iconify-icon icon="solar:danger-triangle-bold" class="fs-32 text-warning"></iconify-icon>
        </div>

        <span class="badge bg-warning bg-opacity-25 text-warning fs-12 mb-3">
           {{ __('global.too_many_requests_badge') }}
        </span>

        <h2 class="fw-bold fs-22 mb-2">
            {{ __('global.too_many_requests_title') }}
        </h2>
        <p class="text-muted mb-4">
          {{ __('global.too_many_requests_desc') }}
        </p>

        <div class="d-flex align-items-center gap-3 bg-light rounded p-3 mb-4 text-start">
            <iconify-icon icon="solar:clock-circle-bold" class="fs-24 text-warning flex-shrink-0"></iconify-icon>
            <div>
                <div class="text-muted fs-13">
                    {{ __('global.too_many_requests_timer') }}
                </div>
                <div class="fw-bold fs-18" id="timer">
                 {{ session('retryAfter', 60) }} {{ __('global.too_many_requests_seconds') }}                
                </div>
            </div>
        </div>

        <hr class="mb-4">

        <a href="{{ route('v1.dashboard.login.index') }}" class="btn btn-sm btn-soft-primary d-inline-flex align-items-center justify-content-center gap-2" style="min-width: 100px;">
            <iconify-icon icon="solar:arrow-right-linear"></iconify-icon>
            {{ __('global.back') }}
        </a>
    </div>
</div>

<script src="{{ asset('assets/js/dashboard/vendor/vendor.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/app.js') }}"></script>
<script>
    const seconds_label = "{{ __('global.too_many_requests_seconds') }}";
    const done_label    = "{{ __('global.too_many_requests_done') }}";

    // الوقت الحقيقي القادم من Laravel
    const totalSeconds = {{ session('retryAfter') ?? 60 }};

    // نحفظ وقت انتهاء الـ block في localStorage
    const storageKey = 'rate_limit_until';
    const now = Math.floor(Date.now() / 1000);

    // لو مفيش وقت محفوظ أو الوقت المحفوظ أقل من الوقت الحالي → ابدأ من الأول
    if (!localStorage.getItem(storageKey) || parseInt(localStorage.getItem(storageKey)) < now) {
        localStorage.setItem(storageKey, now + totalSeconds);
    }

    const until = parseInt(localStorage.getItem(storageKey));
    const el = document.getElementById('timer');

    function tick() {
        const remaining = until - Math.floor(Date.now() / 1000);
        if (remaining <= 0) {
            el.textContent = done_label;
            el.classList.add('text-success');
            localStorage.removeItem(storageKey);
            return;
        }
        el.textContent = remaining + ' ' + seconds_label;
        setTimeout(tick, 1000);
    }

    tick();
</script>
</body>
</html>