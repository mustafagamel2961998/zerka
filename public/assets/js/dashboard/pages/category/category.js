
document.addEventListener("DOMContentLoaded", function () {
    const tableElement = document.getElementById("my-category-html-table");

    if (tableElement) {
        new gridjs.Grid({
            from: tableElement,
            sort: true,
            // search: true
        }).render(document.getElementById("table-category-gridjs"));
    }


    document.getElementById('category_cover').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const uploadMsg = document.getElementById('dropzone_upload_msg');
        const previewContainer = document.getElementById('preview_container');
        const previewImg = document.getElementById('cover_preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // تعيين مسار الصورة الجديد
                previewImg.setAttribute('src', e.target.result);
                // إخفاء رسالة الرفع وإظهار حاوية الصورة
                uploadMsg.classList.add('d-none');
                previewContainer.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        }
    });

    const statusSwitch = document.getElementById('status');

    if (statusSwitch) {
        if (statusSwitch.checked) {
            statusSwitch.value = 'active';
        } else {
            statusSwitch.value = 'inactive';
        }
        statusSwitch.addEventListener('change', function () {
            if (this.checked) {
                this.value = 'active';
            } else {
                this.value = 'inactive';
            }
        });
    }

});
document.addEventListener('DOMContentLoaded', function () {
    // التأكد من أن الـ Modal موجود في الصفحة أولاً
    const modalElement = document.getElementById('seoModal');
    if (!modalElement) return;
    
    const seoModal = new bootstrap.Modal(modalElement);
    
    // مراقبة الضغط على مستوى الصفحة بالكامل (حل مشكلة الـ Dynamic DOM والـ Gridjs)
    document.addEventListener('click', function (event) {
        // البحث عن الزرار أو أي عنصر جواه (مثل الأيقونة) يحمل كلاس open-seo-modal
        const button = event.target.closest('.open-seo-modal');
        
        if (button) {
            event.preventDefault(); // منع أي سلوك افتراضي للزرار

            // جلب البيانات من الـ attributes
            const title = button.getAttribute('data-title') || '';
            const desc = button.getAttribute('data-desc') || '';
            const categoryName = button.getAttribute('data-category') || '';

            // حقن البيانات داخل الـ Modal بأمان
            document.getElementById('seo-category-name').textContent = categoryName;
            document.getElementById('seo-meta-title').textContent = title;
            document.getElementById('seo-meta-desc').textContent = desc;

            // إظهار الـ Modal
            seoModal.show();
        }
    });
});