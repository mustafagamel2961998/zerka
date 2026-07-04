    <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
        class="{{ app()->getLocale() }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title }}</title>

        <!-- Bootstrap 5.3 CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/layout/layout.css') }}">
        @stack('css')
    </head>

    <body class="bg-white text-dark" style="font-family: system-ui, -apple-system, sans-serif;">
        <!-- 1. Navbar (Full Width) -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-black sticky-top py-3">
            <div class="container-fluid px-md-5">
                <!-- Logo -->
                <a class="navbar-brand fw-bold tracking-widest text-uppercase fs-3" href="#" style="letter-spacing: 4px;">ZERKA</a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Links -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav gap-4 text-uppercase small fw-medium">
                        <li class="nav-item">
                            <a href="{{route('home')}}" class="nav-link active text-white border-bottom border-white pb-1">
                            {{ __('front.home') }}
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-white-50" href="#">Shop</a></li>
                        <li class="nav-item"><a class="nav-link text-white-50" href="#">Collections</a></li>
                        <li class="nav-item"><a class="nav-link text-white-50" href="#">About Us</a></li>
                    </ul>
                </div>

                <!-- Icons Buttons -->
                <div class="d-flex align-items-center gap-4 text-white">
                    <!-- Search: دايماً ظاهر -->
                    <a href="#" class="text-white text-decoration-none">
                        <i class="bi bi-search fs-5"></i>
                    </a>

                    <div class="dropdown">
                        <a class="text-white text-decoration-none dropdown-toggle d-flex align-items-center gap-1"
                            href="#" role="button" id="langDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe2 fs-5"></i>
                            <span class="small text-uppercase fw-medium">{{ app()->getLocale() }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark bg-black border border-secondary mt-2" aria-labelledby="langDropdown">
                            <li>
                                <a class="dropdown-item text-white-50" href="{{ route('lang.switch', 'ar') }}">
                                    {{ __('global.arabic') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white-50" href="{{ route('lang.switch', 'en') }}">
                                    {{ __('global.english') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    @guest
                        <!-- مش مسجل دخول: لينكات Login / Register -->
                        <a href="" class="text-white text-decoration-none small text-uppercase fw-medium">
                            تسجيل الدخول
                        </a>
                        <a href="" class="text-white text-decoration-none small text-uppercase fw-medium border-{{ app()->getLocale() == 'ar' ? 'end' : 'start' }} border-secondary px-4">
                            حساب جديد
                        </a>
                    @else
                        <!-- مسجل دخول: Dropdown باسم اليوزر -->
                        <div class="dropdown">
                            <a class="text-white text-decoration-none dropdown-toggle d-flex align-items-center gap-2"
                                href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person fs-5"></i>
                                <span class="small text-uppercase fw-medium">{{ auth()->user()->profile->first_name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark bg-black border border-secondary mt-2" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item text-white-50" href="#">
                                        {{__('global.profile')}}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-white-50" href="#">
                                        {{__('global.my_orders')}}
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-secondary"></li>
                                <li>
                                    <form method="POST" action="">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-white-50">
                                            {{ __('global.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                        <!-- Cart: يظهر بس لو مسجل دخول -->
                        <button class="btn p-0 text-white position-relative border-0" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#cartSidebar">
                            <i class="bi bi-bag fs-5"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-black fw-bold px-1.5 py-0.5"
                                style="font-size: 0.6rem; min-width: 15px;">0</span>
                        </button>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- 2. Hero Section (Slider - Full Width) -->
        <div id="heroCarousel" class="carousel slide carousel-fade bg-black" data-bs-ride="carousel">
            <!-- Slide Indicators -->
            <div class="carousel-indicators mb-4 justify-content-start ms-md-5 ps-md-4">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active rounded-pill"
                    style="width: 25px; height: 5px;"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" class="rounded-pill"
                    style="width: 10px; height: 5px;"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" class="rounded-pill"
                    style="width: 10px; height: 5px;"></button>
            </div>

            <div class="carousel-inner">
                <!-- Slide 1 (The exact image aesthetic) -->
                <div class="carousel-item active"
                    style="min-height: 85vh; background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1618354691373-d851c5c3a990?q=80&w=1400') center/cover no-repeat;">
                    <div class="container h-100 d-flex align-items-center" style="min-height: 85vh;">
                        <div class="row w-100">
                            <div class="col-md-6 text-white z-2">
                                <h1 class="display-3 fw-bold text-uppercase mb-3"
                                    style="line-height: 1.1; letter-spacing: -1px;">
                                    You Don't<br>Wear Zerka.<br>You Represent It.
                                </h1>
                                <p class="text-white-50 mb-4 fs-6">Minimal looks. Maximum impact.</p>
                                <a href="#"
                                    class="btn btn-light rounded-0 px-4 py-2.5 fw-semibold text-uppercase fs-6 tracking-wider shadow-sm">
                                    Shop Now <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item"
                    style="min-height: 85vh; background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1509631179647-0177331693ae?q=80&w=1400') center/cover no-repeat;">
                    <div class="container h-100 d-flex align-items-center" style="min-height: 85vh;">
                        <div class="row w-100">
                            <div class="col-md-6 text-white">
                                <h1 class="display-3 fw-bold text-uppercase mb-3" style="line-height: 1.1;">
                                    New Season<br>Essentials.
                                </h1>
                                <p class="text-white-50 mb-4 fs-6">Drop 01 // Available Online Now</p>
                                <a href="#"
                                    class="btn btn-light rounded-0 px-4 py-2.5 fw-semibold text-uppercase fs-6">
                                    Explore <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>









        <!-- باقي المحتوى كله متناسق بـ Container محدد العرض زي الصورة بالظبط مش 100% -->
        <div class="container my-5">
            {{ $slot }}


            <!-- 8. Footer -->
            <footer class="pt-4 text-dark">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div>
                        <h5 class="fw-bold text-uppercase m-0 tracking-widest" style="letter-spacing: 2px;">ZERKA</h5>
                        <small class="text-muted" style="font-size: 0.7rem;">&copy; 2026 ZERKA. All Rights
                            Reserved.</small>
                    </div>
                    <div class="d-flex gap-4 small text-uppercase text-muted"
                        style="font-size: 0.75rem; font-weight: 500;">
                        <a href="#" class="text-dark text-decoration-none">Shop</a>
                        <a href="#" class="text-dark text-decoration-none">Collections</a>
                        <a href="#" class="text-dark text-decoration-none">About Us</a>
                        <a href="#" class="text-dark text-decoration-none">Contact</a>
                    </div>
                    <div class="d-flex gap-3 fs-5">
                        <a href="#" class="text-dark"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-tiktok"></i></a>
                        <a href="#" class="text-dark"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
            </footer>

        </div> <!-- End Container -->

        <!-- 9. Cart Offcanvas Sidebar (شغالة وجاهزة للباك إند) -->
        <div class="offcanvas offcanvas-end bg-white text-dark rounded-0" tabindex="-1" id="cartSidebar"
            aria-labelledby="cartSidebarLabel">
            <div class="offcanvas-header border-bottom border-light-subtle py-3">
                <h5 class="offcanvas-title fw-bold text-uppercase tracking-wider fs-6" id="cartSidebarLabel">Your Bag
                    (0)</h5>
                <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between">
                <!-- الـ Items اللي جوة الكارت (فاضية حالياً ومجهزة للـ Backend Loop) -->
                <div class="cart-items-wrapper">
                    <p class="text-muted text-center py-5 my-5 small">Your cart is currently empty.</p>
                </div>

                <!-- إجمالي السلة وأزرار الدفع (تظهر دايماً تحت) -->
                <div class="border-top border-light-subtle pt-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-uppercase small fw-semibold text-muted">Subtotal:</span>
                        <span class="fw-bold fs-5">EGP 0.00</span>
                    </div>
                    <a href="#"
                        class="btn btn-black w-100 rounded-0 text-white text-uppercase fw-bold py-2.5 bg-black fs-7 mb-2">Proceed
                        To Checkout</a>
                    <button type="button"
                        class="btn btn-outline-dark w-100 rounded-0 text-uppercase fw-semibold py-2 small"
                        data-bs-dismiss="offcanvas">Continue Shopping</button>
                </div>
            </div>
        </div>


        <!-- Bootstrap 5.3 JavaScript Bundle CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        @stack('js')
    </body>

    </html>
