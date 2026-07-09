<x-front.layout title="{{ auth()->user()->profile->full_name }}">
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/css/front/pages/order/order.css') }}">
    @endpush

    @push('js')
        <script src="{{ asset('assets/js/front/pages/order/order.js') }}"></script>
    @endpush
</x-front.layout>
