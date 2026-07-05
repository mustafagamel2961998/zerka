

document.addEventListener("DOMContentLoaded", function () {

    const productImagesInput = document.getElementById('product_images');
    const uploadMsg = document.getElementById('dropzone_upload_msg');
    const previewContainer = document.getElementById('preview_container');
    const imagesRow = previewContainer ? previewContainer.querySelector('.images-grid-row') : null;

    // دالة مساعدة للتحقق من حالة الحاوية (هل أصبحت فارغة بعد الحذف؟)
    function checkContainerEmptiness() {
        if (previewContainer && previewContainer.querySelectorAll('.product-img-wrap').length === 0) {
            previewContainer.classList.add('d-none');
            uploadMsg.classList.remove('d-none');
            if (productImagesInput) productImagesInput.value = "";
        }
    }

    // --------------------------------------------------------
    // أولاً: منطق رفع ومعاينة الصور الجديدة
    // --------------------------------------------------------
    if (productImagesInput) {
        productImagesInput.addEventListener('change', function (event) {
            const files = event.target.files;

            // مسح أي معاينة ديناميكية سابقة تم اختيارها في نفس الجلسة
            const oldDynamicPreviews = previewContainer.querySelectorAll('.dynamic-preview');
            oldDynamicPreviews.forEach(el => el.remove());

            if (files.length > 0) {
                uploadMsg.classList.add('d-none');
                previewContainer.classList.remove('d-none');

                Array.from(files).forEach((file) => {
                    if (!file.type.match('image.*')) return; 

                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const col = document.createElement('div');
                        col.className = 'col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-3 dynamic-preview';
                        
                        col.innerHTML = `
                            <div class="position-relative product-img-wrap shadow-sm rounded border border-light" style="overflow: hidden;">
                                <img src="${e.target.result}" alt="Preview" class="product_image_preview w-100" style="height: 110px; object-fit: contain; display: block;">
                                <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-1 remove-preview-btn d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; padding: 0; font-size: 14px; z-index: 5;">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                        `;

                        col.querySelector('.remove-preview-btn').addEventListener('click', function() {
                            col.remove();
                            checkContainerEmptiness();
                        });

                        imagesRow.appendChild(col);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                checkContainerEmptiness();
            }
        });
    }

    // --------------------------------------------------------
    // ثانياً: منطق حذف الصور المحفوظة مسبقاً على السيرفر (AJAX)
    // --------------------------------------------------------
    if (previewContainer) {
        previewContainer.addEventListener('click', function (event) {
            // استخدام Event Delegation للتعامل مع أزرار حذف صور السيرفر
            const btn = event.target.closest('.remove-server-img-btn');
            if (!btn) return;

            event.preventDefault();
            event.stopPropagation(); // لمنع فتح الـ file browser عند الضغط على الزر

            const serverPreviewCol = btn.closest('.server-preview');
            const mediaId = serverPreviewCol.getAttribute('data-media-id');

            if (confirm("هل أنت متأكد من حذف هذه الصورة نهائياً؟")) {
                // تأمين طلب الحذف بـ CSRF Token من الميتا تاغ المعتادة في لارافل
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                btn.disabled = true;
                btn.innerHTML = `<i class="bx bx-loader-alt bx-spin"></i>`;

                fetch(`/dashboard/v1/products/media/destroy/${mediaId}`, { // قم بتغيير الـ URL حسب الـ Route عندك
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        serverPreviewCol.remove();
                        checkContainerEmptiness();
                    } else {
                        alert('حدث خطأ أثناء حذف الصورة، برجاء المحاولة لاحقاً.');
                        btn.disabled = false;
                        btn.innerHTML = `<i class="bx bx-x"></i>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('فشل الاتصال بالسيرفر.');
                    btn.disabled = false;
                    btn.innerHTML = `<i class="bx bx-x"></i>`;
                });
            }
        });
    }

});

document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById('variants-container');
    const variantTemplate = document.getElementById('variant-template');
    const colorRowTemplate = document.getElementById('color-row-template');
    const addVariantBtn = document.getElementById('add-variant-btn');

    let variantIndex = container.querySelectorAll('.variant-card').length;

    // -----------------------------------------
    // إضافة سايز (Variant) جديد
    // -----------------------------------------
    addVariantBtn.addEventListener('click', function () {
        const html = variantTemplate.innerHTML.replace(/__vIndex__/g, variantIndex);
        const wrapper = document.createElement('div');
        wrapper.innerHTML = html.trim();
        const card = wrapper.firstElementChild;
        container.appendChild(card);
        variantIndex++;
    });

    // -----------------------------------------
    // حذف سايز كامل
    // -----------------------------------------
    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-variant-btn')) {
            e.target.closest('.variant-card').remove();
        }
    });

    // -----------------------------------------
    // الضغط على دائرة لون -> إضافة صف لون جديد للسايز ده
    // -----------------------------------------
    container.addEventListener('click', function (e) {
        const swatch = e.target.closest('.swatch');
        if (!swatch || swatch.classList.contains('swatch-disabled')) return;

        const variantCard = swatch.closest('.variant-card');
        const vIndex = variantCard.dataset.variantIndex;
        let cIndex = parseInt(variantCard.dataset.colorIndex || '0', 10);

        const colorId = swatch.dataset.colorId;
        const colorCode = swatch.style.backgroundColor;

        const rowHtml = colorRowTemplate.innerHTML
            .replace(/__vIndex__/g, vIndex)
            .replace(/__cIndex__/g, cIndex)
            .replace(/__colorId__/g, colorId)
            .replace(/__colorCode__/g, colorCode);

        const tbody = variantCard.querySelector('.colors-body');
        const rowWrapper = document.createElement('tbody');
        rowWrapper.innerHTML = rowHtml.trim();
        tbody.appendChild(rowWrapper.firstElementChild);

        // قفل السواتش ده عشان متتكررش في نفس السايز
        swatch.classList.add('swatch-disabled');

        variantCard.dataset.colorIndex = cIndex + 1;
    });

    // -----------------------------------------
    // حذف صف لون -> يرجع يفتح السواتش بتاعه تاني
    // -----------------------------------------
    container.addEventListener('click', function (e) {
        const removeBtn = e.target.closest('.remove-color-row');
        if (!removeBtn) return;

        const row = removeBtn.closest('.color-row');
        const variantCard = removeBtn.closest('.variant-card');
        const colorId = row.dataset.colorId;

        const swatch = variantCard.querySelector(`.swatch[data-color-id="${colorId}"]`);
        if (swatch) swatch.classList.remove('swatch-disabled');

        row.remove();
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const tableElement = document.getElementById("my-product-html-table");
   
    if (tableElement) {
            const currentDirection = document.documentElement.dir || 'ltr'; 
            const textAlign = currentDirection === 'rtl' ? 'right' : 'left';

            new gridjs.Grid({
                from: tableElement,
                sort: true,
                direction: currentDirection,
                style: {
                    th: {
                        'text-align': textAlign
                    },
                    td: {
                        'text-align': textAlign
                    }
                }
                // search: true
            }).render(document.getElementById("table-product-gridjs"));
        }
});
// seo modal
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