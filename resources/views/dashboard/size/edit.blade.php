<x-dashboard.layout title="{{ __('global.edit_with_attribute', ['attribute' => __('dashboard.size')]) }} - {{$size->size }}">

    <div class="row">

        <x-dashboard.partial.size.statistics/>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ __('global.edit_with_attribute', ['attribute' => __('dashboard.size')]) }}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                       
                        <form action="{{ route('dashboard.v1.sizes.update',$size->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('dashboard.size._form', [
                                    'size' => $size,
                                    'btn_text' => __('global.edit_with_attribute', ['attribute' => __('dashboard.size')])
                                ])
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/size/size.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/size/size.js') }}"></script>
    @endpush
</x-dashboard.layout>
