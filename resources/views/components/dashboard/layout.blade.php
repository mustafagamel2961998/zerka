<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    class="{{ app()->getLocale() }}">

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully responsive premium admin dashboard template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- boxicons css (Require in all Page) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Flags Icons css (Require in all Page) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />

    <!-- Vendor css (Require in all Page) -->
    <link href="{{ asset('assets/css/dashboard/vendor/vendor.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Gridjs Plugin css -->
    <link href="{{ asset('assets/css/dashboard/vendor/theme/grid/mermaid.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="{{ asset('assets/css/dashboard/vendor/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css (Require in all Page) -->
    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('assets/css/dashboard/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{ asset('assets/css/dashboard/app.min.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <!-- Theme Config js (Require in all Page) -->
    <script src="{{ asset('assets/js/dashboard/vendor/config.js') }}"></script>
    @stack('css')
</head>

<body>

    <!-- START Wrapper -->
    <div class="wrapper">

        <!-- ========== Topbar Start ========== -->
        <header class="topbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="d-flex align-items-center">
                        <!-- Menu Toggle Button -->
                        <div class="topbar-item">
                            <button type="button" class="button-toggle-menu me-2">
                                <iconify-icon icon="solar:hamburger-menu-broken"
                                    class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div>

                        <!-- Menu Toggle Button -->
                        <div class="topbar-item">
                            <h4 class="fw-bold topbar-button pe-none text-uppercase mb-0">
                                {{ __('dashboard.welcome') }}
                            </h4>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-1">

                        <!-- Theme Color (Light/Dark) -->
                        <div class="topbar-item">
                            <button type="button" class="topbar-button" id="light-dark-mode">
                                <iconify-icon icon="solar:moon-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div>

                        <!-- Notification -->
                        {{-- <div class="dropdown topbar-item">
                                   <button type="button" class="topbar-button position-relative" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <iconify-icon icon="solar:bell-bing-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                                        <span class="position-absolute topbar-badge fs-10 translate-middle badge bg-danger rounded-pill">3<span class="visually-hidden">unread messages</span></span>
                                   </button>
                                   <div class="dropdown-menu py-0 dropdown-lg dropdown-menu-end" aria-labelledby="page-header-notifications-dropdown">
                                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                             <div class="row align-items-center">
                                                  <div class="col">
                                                       <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                                                  </div>
                                                  <div class="col-auto">
                                                       <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                                            <small>Clear All</small>
                                                       </a>
                                                  </div>
                                             </div>
                                        </div>
                                        <div data-simplebar style="max-height: 280px;">
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom text-wrap">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <img src="{{ asset('assets/images/dashboard/users/avatar-1.jpg') }}" class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-1" />
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0"><span class="fw-medium">Josephine Thompson </span>commented on admin panel <span>" Wow 😍! this admin looks good and awesome design"</span></p>
                                                       </div>
                                                  </div>
                                             </a>
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <div class="avatar-sm me-2">
                                                                 <span class="avatar-title bg-soft-info text-info fs-20 rounded-circle">
                                                                      D
                                                                 </span>
                                                            </div>
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0 fw-semibold">Donoghue Susan</p>
                                                            <p class="mb-0 text-wrap">
                                                                 Hi, How are you? What about our next meeting
                                                            </p>
                                                       </div>
                                                  </div>
                                             </a>
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <img src="{{ asset('assets/images/dashboard/users/avatar-3.jpg') }}" class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-3" />
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0 fw-semibold">Jacob Gines</p>
                                                            <p class="mb-0 text-wrap">Answered to your comment on the cash flow forecast' graph 🔔.</p>
                                                       </div>
                                                  </div>
                                             </a>
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <div class="avatar-sm me-2">
                                                                 <span class="avatar-title bg-soft-warning text-warning fs-20 rounded-circle">
                                                                      <iconify-icon icon="iconamoon:comment-dots-duotone"></iconify-icon>
                                                                 </span>
                                                            </div>
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0 fw-semibold text-wrap">You have received <b>20</b> new messages in the
                                                                 conversation</p>
                                                       </div>
                                                  </div>
                                             </a>
                                             <!-- Item -->
                                             <a href="javascript:void(0);" class="dropdown-item py-3 border-bottom">
                                                  <div class="d-flex">
                                                       <div class="flex-shrink-0">
                                                            <img src="{{ asset('assets/images/dashboard/users/avatar-5.jpg') }}" class="img-fluid me-2 avatar-sm rounded-circle" alt="avatar-5" />
                                                       </div>
                                                       <div class="flex-grow-1">
                                                            <p class="mb-0 fw-semibold">Shawn Bunch</p>
                                                            <p class="mb-0 text-wrap">
                                                                 Commented on Admin
                                                            </p>
                                                       </div>
                                                  </div>
                                             </a>
                                        </div>
                                        <div class="text-center py-3">
                                             <a href="javascript:void(0);" class="btn btn-primary btn-sm">View All Notification <i class="bx bx-right-arrow-alt ms-1"></i></a>
                                        </div>
                                   </div>
                              </div> --}}

                        <!-- Theme Setting -->
                        <div class="topbar-item d-none d-md-flex">
                            <button type="button" class="topbar-button" id="theme-settings-btn"
                                data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
                                aria-controls="theme-settings-offcanvas">
                                <iconify-icon icon="solar:settings-bold-duotone"
                                    class="fs-24 align-middle"></iconify-icon>
                            </button>
                        </div>
                        <!-- Activity -->
                        {{-- <div class="topbar-item d-none d-md-flex">
                                   <button type="button" class="topbar-button" id="theme-settings-btn" data-bs-toggle="offcanvas" data-bs-target="#theme-activity-offcanvas" aria-controls="theme-settings-offcanvas">
                                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                                   </button>
                              </div> --}}

                        <!-- Language Dropdown -->
                        <div class="dropdown topbar-item">
                            <a href="{{ route('lang.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}">
                                <button type="button" class="topbar-button" id="page-header-language-dropdown">
                                    <iconify-icon icon="solar:earth-bold-duotone"
                                        class="fs-24 align-middle"></iconify-icon>
                                </button>
                            </a>
                            {{-- <div class="dropdown-menu dropdown-menu-end p-1" style="min-width: 140px;" aria-labelledby="page-header-language-dropdown">
                                        @if (app()->getLocale() == 'ar')
                                        <!-- English -->
                                        <a href="{{ route('lang.switch', 'en') }}" class="dropdown-item d-flex align-items-center justify-content-between py-2 active">
                                             <span class="align-middle">
                                                  {{ __('dashboard.english') }}
                                             </span>
                                             <iconify-icon icon="twemoji:flag-united-states" class="fs-18"></iconify-icon>
                                        </a>
                                        @else
                                        <!-- Arabic -->
                                        <a href="{{ route('lang.switch', 'ar') }}" class="dropdown-item d-flex align-items-center justify-content-between py-2">
                                             <span class="align-middle">
                                                  {{ __('dashboard.arabic') }}
                                             </span>
                                             <iconify-icon icon="twemoji:flag-egypt" class="fs-18"></iconify-icon> <!-- تقدر تغير العلم حسب بلدك -->
                                        </a>
                                        @endif
                                   </div> --}}
                        </div>

                        <!-- User -->
                        <div class="dropdown topbar-item">
                            <a type="button" class="topbar-button" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle" width="32"
                                        src="{{ auth()->user()->getFirstMediaUrl('avatar') }}"
                                        alt="{{ auth()->user()->profile->full_name }}">
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">
                                    {{ __('global.welcome') }} {{ auth()->user()->profile->full_name }}
                                </h6>
                                <div class="dropdown-divider my-1"></div>
                                <a class="dropdown-item text-danger" href="{{ route('dashboard.v1.logout') }}">
                                    <i class="bx bx-log-out fs-18 align-middle me-1"></i>
                                    <span class="align-middle">
                                        {{ __('dashboard.logout') }}
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- App Search-->
                        <form class="app-search d-none d-md-block ms-2">
                            <div class="position-relative">
                                <input type="search" class="form-control" placeholder="Search..." autocomplete="off"
                                    value="">
                                <iconify-icon icon="solar:magnifer-linear" class="search-widget-icon"></iconify-icon>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Activity Timeline -->
        <div>
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-activity-offcanvas"
                style="max-width: 450px; width: 100%;">
                <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                    <h5 class="text-white m-0 fw-semibold">Activity Stream</h5>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <div class="offcanvas-body p-0">
                    <div data-simplebar class="h-100 p-4">
                        <div class="position-relative ms-2">
                            <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-danger d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon
                                            icon="iconamoon:folder-check-duotone"></iconify-icon></span>
                                    <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15 lh-base">Report-Fix / Update </h5>
                                        <p class="d-flex align-items-center">Add 3 files to <span
                                                class=" d-flex align-items-center text-primary ms-1"><iconify-icon
                                                    icon="iconamoon:file-light"></iconify-icon> Tasks</span></p>
                                        <div class="bg-light bg-opacity-50 rounded-2 p-2">
                                            <div class="row">
                                                <div class="col-lg-6 border-end border-light">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="bx bxl-figma fs-20 text-red"></i>
                                                        <a href="#!" class="text-dark fw-medium">Concept.fig</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="bx bxl-file-doc fs-20 text-success"></i>
                                                        <a href="#!" class="text-dark fw-medium">larkon.docs</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="mt-2 text-muted">Monday , 4:24 PM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-success d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon
                                            icon="iconamoon:check-circle-1-duotone"></iconify-icon></span>
                                    <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15 lh-base">Project Status
                                        </h5>
                                        <p class="d-flex align-items-center mb-0">Marked<span
                                                class=" d-flex align-items-center text-primary mx-1"><iconify-icon
                                                    icon="iconamoon:file-light"></iconify-icon> Design </span> as <span
                                                class="badge bg-success-subtle text-success px-2 py-1 ms-1">
                                                Completed</span></p>
                                        <div
                                            class="d-flex align-items-center gap-3 mt-1 bg-light bg-opacity-50 p-2 rounded-2">
                                            <a href="#!" class="fw-medium text-dark">UI/UX Figma Design</a>
                                            <div class="ms-auto">
                                                <a href="#!" class="fw-medium text-primary fs-18"
                                                    data-bs-toggle="tooltip" data-bs-title="Download"
                                                    data-bs-placement="bottom"><iconify-icon
                                                        icon="iconamoon:cloud-download-duotone"></iconify-icon></a>
                                            </div>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday , 3:00 PM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-primary d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-16">UI</span>
                                    <div class="ms-2">
                                        <h5 class="mb-1 text-dark fw-semibold fs-15">Larkon Application UI v2.0.0 <span
                                                class="badge bg-primary-subtle text-primary px-2 py-1 ms-1">
                                                Latest</span>
                                        </h5>
                                        <p>Get access to over 20+ pages including a dashboard layout, charts, kanban
                                            board, calendar, and pre-order E-commerce & Marketing pages.</p>
                                        <div class="mt-2">
                                            <a href="#!" class="btn btn-light btn-sm">Download Zip</a>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday , 2:10 PM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20">
                                        <img src="{{ asset('assets/images/dashboard/users/avatar-7.jpg') }}"
                                            alt="avatar-5" class="avatar-sm rounded-circle"></span>
                                    <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Alex Smith Attached Photos
                                        </h5>
                                        <div class="row g-2 mt-2">
                                            <div class="col-lg-4">
                                                <a href="#!">
                                                    <img src="{{ asset('assets/images/dashboard/small/img-6.jpg') }}"
                                                        alt="" class="img-fluid rounded">
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <a href="#!">
                                                    <img src="{{ asset('assets/images/dashboard/small/img-3.jpg') }}"
                                                        alt="" class="img-fluid rounded">
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <a href="#!">
                                                    <img src="{{ asset('assets/images/dashboard/small/img-4.jpg') }}"
                                                        alt="" class="img-fluid rounded">
                                                </a>
                                            </div>
                                        </div>
                                        <h6 class="mt-3 text-muted">Monday 1:00 PM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 translate-middle-x bg-success bg-gradient d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><img
                                            src="{{ asset('assets/images/dashboard/users/avatar-6.jpg') }}"
                                            alt="avatar-5" class="avatar-sm rounded-circle"></span>
                                    <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Rebecca J. added a new
                                            team member
                                        </h5>
                                        <p class="d-flex align-items-center gap-1"><iconify-icon
                                                icon="iconamoon:check-circle-1-duotone"
                                                class="text-success"></iconify-icon> Added a new member to Front
                                            Dashboard</p>
                                        <h6 class="mt-3 text-muted">Monday 10:00 AM</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative ps-4">
                                <div class="mb-4">
                                    <span
                                        class="position-absolute start-0 avatar-sm translate-middle-x bg-warning d-inline-flex align-items-center justify-content-center rounded-circle text-light fs-20"><iconify-icon
                                            icon="iconamoon:certificate-badge-duotone"></iconify-icon></span>
                                    <div class="ms-2">
                                        <h5 class="mb-0 text-dark fw-semibold fs-15 lh-base">Achievements
                                        </h5>
                                        <p class="d-flex align-items-center gap-1 mt-1">Earned a <iconify-icon
                                                icon="iconamoon:certificate-badge-duotone"
                                                class="text-danger fs-20"></iconify-icon>" Best Product Award"</p>
                                        <h6 class="mt-3 text-muted">Monday 9:30 AM</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#!" class="btn btn-outline-dark w-100">View All</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar (Theme Settings) -->
        <div>
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="theme-settings-offcanvas">
                <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                    <h5 class="text-white m-0">Theme Settings</h5>
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <div class="offcanvas-body p-0">
                    <div data-simplebar class="h-100">
                        <div class="p-3 settings-bar">

                            <div>
                                <h5 class="mb-3 font-16 fw-semibold">Color Scheme</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-bs-theme"
                                        id="layout-color-light" value="light">
                                    <label class="form-check-label" for="layout-color-light">Light</label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-bs-theme"
                                        id="layout-color-dark" value="dark">
                                    <label class="form-check-label" for="layout-color-dark">Dark</label>
                                </div>
                            </div>

                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Topbar Color</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-topbar-color"
                                        id="topbar-color-light" value="light">
                                    <label class="form-check-label" for="topbar-color-light">Light</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-topbar-color"
                                        id="topbar-color-dark" value="dark">
                                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                                </div>
                            </div>


                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Menu Color</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-light" value="light">
                                    <label class="form-check-label" for="leftbar-color-light">
                                        Light
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-dark" value="dark">
                                    <label class="form-check-label" for="leftbar-color-dark">
                                        Dark
                                    </label>
                                </div>
                            </div>

                            <div>
                                <h5 class="my-3 font-16 fw-semibold">Sidebar Size</h5>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-default" value="default">
                                    <label class="form-check-label" for="leftbar-size-default">
                                        Default
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-small" value="condensed">
                                    <label class="form-check-label" for="leftbar-size-small">
                                        Condensed
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-hidden" value="hidden">
                                    <label class="form-check-label" for="leftbar-hidden">
                                        Hidden
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-small-hover-active" value="sm-hover-active">
                                    <label class="form-check-label" for="leftbar-size-small-hover-active">
                                        Small Hover Active
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="data-menu-size"
                                        id="leftbar-size-small-hover" value="sm-hover">
                                    <label class="form-check-label" for="leftbar-size-small-hover">
                                        Small Hover
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="offcanvas-footer border-top p-3 text-center">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100" id="reset-layout">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <!-- ========== App Menu Start ========== -->
        <div class="main-nav">
            <!-- Sidebar Logo -->
            <div class="logo-box">
                <a href="index-2.html" class="logo-dark">
                    <img src="{{ asset('assets/images/dashboard/logo-sm.png') }}" class="logo-sm" alt="logo sm">
                    <img src="{{ asset('assets/images/dashboard/logo-dark.png') }}" class="logo-lg" alt="logo dark">
                </a>

                <a href="index-2.html" class="logo-light">
                    <img src="{{ asset('assets/images/dashboard/logo-sm.png') }}" class="logo-sm" alt="logo sm">
                    <img src="{{ asset('assets/images/dashboard/logo-light.png') }}" class="logo-lg"
                        alt="logo light">
                </a>
            </div>

            <!-- Menu Toggle Button (sm-hover) -->
            <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                <iconify-icon icon="solar:double-alt-arrow-right-bold-duotone"
                    class="button-sm-hover-icon"></iconify-icon>
            </button>

            <div class="scrollbar" data-simplebar>
                <ul class="navbar-nav" id="navbar-nav">

                    <li class="menu-title">
                        {{ __('dashboard.general') }}
                    </li>

                    <li class="nav-item">
                        <a class="nav-link 
             @if (request()->routeIs('dashboard.v1.home.*')) active @endif"
                            href="{{ route('dashboard.v1.home') }}">
                            <span class="nav-icon">
                                <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                            </span>
                            <span class="nav-text">
                                {{ __('dashboard.dashboard') }}
                            </span>
                        </a>
                    </li>
                    @can('view-currencies')
                        <li class="nav-item">
                            <a class="nav-link 
                             @if (request()->routeIs('dashboard.v1.currencies.*')) active @endif"
                                href="{{ route('dashboard.v1.currencies.index') }}">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:dollar-minimalistic-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.currencies') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('view-countries')
                        <li class="nav-item">
                            <a class="nav-link 
                            @if (request()->routeIs('dashboard.v1.countries.*')) active @endif"
                                href="{{ route('dashboard.v1.countries.index') }}">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:flag-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.countries') }}
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('view-cities')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('dashboard.v1.cities.*')) active @endif"
                                href="{{ route('dashboard.v1.cities.index') }}">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:city-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.cities') }}
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('view-categories')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('dashboard.v1.categories.*')) active @endif"
                                href="{{ route('dashboard.v1.categories.index') }}">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:clipboard-list-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.categories') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('view-colors')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('dashboard.v1.colors.*')) active @endif"
                                href="{{ route('dashboard.v1.colors.index') }}">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:palette-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.colors') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('view-sizes')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('dashboard.v1.sizes.*')) active @endif"
                                href="{{ route('dashboard.v1.sizes.index') }}">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:ruler-angular-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.sizes') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('view-warehouses')
                        <li class="nav-item">
                            <a class="nav-link menu-arrow @if (request()->routeIs('dashboard.v1.warehouses.*')) active @endif"
                                href="#sidebarInventory" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarInventory">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.inventories') }}
                                </span>
                            </a>
                            <div class="collapse @if (request()->routeIs('dashboard.v1.warehouses.*')) show @endif" id="sidebarInventory">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a class="sub-nav-link"
                                            href="{{ route('dashboard.v1.warehouses.index') }}">{{ __('dashboard.all_warehouses') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @can('view-products')
                        <li class="nav-item">
                            <a class="nav-link menu-arrow @if (request()->routeIs('dashboard.v1.products.*')) active @endif collapsed"
                                href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarProducts">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:t-shirt-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.products') }}
                                </span>
                            </a>
                            <div class="collapse @if (request()->routeIs('dashboard.v1.products.*')) show @endif" id="sidebarProducts">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a class="sub-nav-link" href="{{ route('dashboard.v1.products.index') }}">
                                            {{ __('dashboard.all_products') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('view-orders')
                        <li class="nav-item">
                            <a class="nav-link menu-arrow @if (request()->routeIs('dashboard.v1.orders.*')) active @endif"
                                href="#sidebarOrders" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarOrders">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:bag-smile-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.orders') }}
                                </span>
                            </a>
                            <div class="collapse @if (request()->routeIs('dashboard.v1.orders.*')) show @endif" id="sidebarOrders">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a class="sub-nav-link" href="{{ route('dashboard.v1.orders.index') }}">
                                            <span class="nav-text">
                                                {{ __('dashboard.all_orders') }}
                                            </span>
                                            @if ($pendingOrdersCount)
                                                <span class="badge bg-danger badge-pill text-end">
                                                    {{ $pendingOrdersCount }}
                                                </span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="sub-nav-item">
                                        <a class="sub-nav-link" href="{{ route('dashboard.v1.refund.request') }}">
                                            <span class="nav-text">
                                                {{ __('dashboard.refund_request') }}
                                            </span>
                                            @if ($pendingRefundCount)
                                                <span class="badge bg-danger badge-pill text-end">
                                                    {{ $pendingRefundCount }}
                                                </span>
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @can('view-invoices')
                        <li class="nav-item">
                            <a class="nav-link menu-arrow @if (request()->routeIs('dashboard.v1.invoices.*')) active @endif"
                                href="#sidebarInvoice" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarInvoice">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:bill-list-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.invoices') }}
                                </span>
                            </a>
                            <div class="collapse @if (request()->routeIs('dashboard.v1.orders.*')) show @endif" id="sidebarInvoice">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a class="sub-nav-link" href="{{ route('dashboard.v1.invoices.index') }}">
                                            {{ __('dashboard.all_invoices') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('view-settings')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('dashboard.v1.settings.*')) active @endif"
                                href="{{ route('dashboard.v1.settings.index') }}">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.settings') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('view-users')
                        <li class="menu-title mt-2">
                            {{ __('dashboard.users') }}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-arrow @if (request()->routeIs('dashboard.v1.customers.*') ||
                                    request()->routeIs('dashboard.v1.managers.*') ||
                                    request()->routeIs('dashboard.v1.users.*')) active @endif"
                                href="#sidebarCustomers" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarCustomers">
                                <span class="nav-icon">
                                    <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                                </span>
                                <span class="nav-text">
                                    {{ __('dashboard.customers_and_managers') }}
                                </span>
                            </a>
                            <div class="collapse @if (request()->routeIs('dashboard.v1.customers.*') ||
                                    request()->routeIs('dashboard.v1.managers.*') ||
                                    request()->routeIs('dashboard.v1.users.*')) show @endif" id="sidebarCustomers">
                                <ul class="nav sub-navbar-nav">
                                    <li class="sub-nav-item">
                                        <a class="sub-nav-link" href="{{ route('dashboard.v1.customers.index') }}">
                                            {{ __('dashboard.all_customers') }}
                                        </a>
                                    </li>
                                    <li class="sub-nav-item">
                                        <a class="sub-nav-link" href="{{ route('dashboard.v1.managers.index') }}">
                                            {{ __('dashboard.managers') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
        <!-- ========== App Menu End ========== -->

        <!-- ==================================================== -->
        <!-- Start right Content here -->
        <!-- ==================================================== -->
        <div class="page-content">

            <!-- Start Container Fluid -->
            <div class="container-fluid">

                {{ $slot }}

            </div>
            <!-- End Container Fluid -->

            <!-- ========== Footer Start ========== -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; {{ __('global.crafted_by') }}
                            <iconify-icon icon="iconamoon:heart-duotone"
                                class="fs-18 align-middle text-danger"></iconify-icon> <a
                                href="{{ __('global.developer_whatsapp_contact') }}" class="fw-bold footer-text"
                                target="_blank">{{ __('global.developer_name') }}</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- ========== Footer End ========== -->

        </div>
        <!-- ==================================================== -->
        <!-- End Page Content -->
        <!-- ==================================================== -->

    </div>
    <!-- END Wrapper -->

    <!-- Vendor Javascript (Require in all Page) -->
    <script src="{{ asset('assets/js/dashboard/vendor/vendor.js') }}"></script>

    <!-- App Javascript (Require in all Page) -->
    <script src="{{ asset('assets/js/dashboard/app.js') }}"></script>

    <!-- Vector Map Js -->
    <script src="{{ asset('assets/js/dashboard/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/vendor/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/vendor/jsvectormap/maps/world.js') }}"></script>

    <!-- Dashboard Js -->
    <script src="{{ asset('assets/js/dashboard/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/pages/main.js') }}"></script>
    @if (session('success'))
        <script>
            const ToastSuccess = Swal.mixin({
                toast: true,
                position: "{{ app()->getLocale() == 'ar' ? 'top-start' : 'top-end' }}", // بيحدد الاتجاه تلقائياً حسب لغة الموقع
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            ToastSuccess.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            const ToastError = Swal.mixin({
                toast: true,
                position: "{{ app()->getLocale() == 'ar' ? 'top-start' : 'top-end' }}",
                showConfirmButton: false,
                timer: 4500, // وقت أطول سنة عشان يلحق يقرأ الخطأ
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            ToastError.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    @stack('javascript')
    <!-- Gridjs Demo js -->
    <script src="{{ asset('assets/js/dashboard/vendor/gridjs/gridjs.umd.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/components/table-gridjs.js') }}"></script>

</body>

</html>
