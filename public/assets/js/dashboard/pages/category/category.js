
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
});

