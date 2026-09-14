<x-dashboard.layout title="{{ __('dashboard.about_us') }}">

    <div class="card rounded-0 border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('dashboard.v1.about-us.update', $about->id) }}" method="POST">
                @csrf

                <!-- المحتوى باللغة العربية -->
                <div class="mb-4">
                    <label for="content_ar" class="form-label font-bold mb-2 block">
                        {{__('front.about_us_ar')}}
                    </label>
                    <textarea name="content[ar]" id="content_ar" class="tinymce-editor">{{ old('content.ar', $about->translations->where('locale', 'ar')->first()->content ?? '') }}</textarea>
                </div>

                <!-- المحتوى باللغة الإنجليزية -->
                <div class="mb-4">
                    <label for="content_en" class="form-label font-bold mb-2 block">
                        {{__('front.about_us_en')}}
                    </label>
                    <textarea name="content[en]" id="content_en" class="tinymce-editor">{{ old('content.en', $about->translations->where('locale', 'en')->first()->content ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-600 text-white rounded">
                    {{ __('front.about_us_update') }}
                </button>
            </form>

            <!-- استدعاء وتفعيل مكتبة TinyMCE -->
            <script src="https://cdn.tiny.cloud/1/1zf7d3cm6ok7sf45uyk62f4412dwvzizt35nsk345a05ia93/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
            <script>
                tinymce.init({
                    selector: 'textarea.tinymce-editor',
                    height: 350,
                    menubar: false,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount', 'directionality'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                        'bold italic backcolor | alignleft aligncenter ' +
                        'alignright alignjustify | bullist numlist outdent indent | ' +
                        'removeformat | ltr rtl | help',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',
                    directionality: 'rtl' // لدعم اتجاه الكتابة العربية
                });
            </script>
        </div>
    </div>

    @push('javascript')
        <script src="{{ asset('assets/js/dashboard/pages/setting/about.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pages/jquery/setting/about.js') }}"></script>
    @endpush
</x-dashboard.layout>
