<x-dashboard.layout title="{{ __('global.edit_with_attribute', ['attribute' => __('dashboard.city')]) }} - {{$color->code }}">

    <div class="row">

        <x-dashboard.partial.color.statistics/>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('global.edit_with_attribute', ['attribute' => __('dashboard.color')]) }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                       
                        <form action="{{ route('dashboard.v1.colors.update',$color->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('dashboard.color._form', [
                                    'color' => $color,
                                    'btn_text' => __('global.edit_with_attribute', ['attribute' => __('dashboard.color')])
                                ])
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/color/color.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/color/color.js') }}"></script>
    @endpush
</x-dashboard.layout>
