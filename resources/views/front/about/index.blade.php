<x-front.layout title="{{ __('front.about_us') }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/about_us/about_us.css') }}">
    @endpush

    <!-- Header Section -->
    <section class="about-hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <span class="hero-subtitle">{{ __('front.welcome_to_store') }}</span>
                <h1 class="hero-title">{{ __('front.about_us') }}</h1>
                <div class="divider-line"></div>
            </div>
        </div>
    </section>

    <!-- Main Dynamic Content Section -->
    <section class="about-main-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="about-card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
                        <!-- Dynamic Rich Text Content -->
                        <div class="about-content rte-content">
                            {!! $about->currentTranslation->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-front.layout>