

document.addEventListener("DOMContentLoaded", function () {

    // --------------------------------------------------------
    // أولاً: منطق رفع ومعاينة الصور المتعددة للمنتج
    // --------------------------------------------------------
    const productImagesInput = document.getElementById('product_images');
    
    if (productImagesInput) {
        productImagesInput.addEventListener('change', function (event) {
            const files = event.target.files;
            const uploadMsg = document.getElementById('dropzone_upload_msg');
            const previewContainer = document.getElementById('preview_container');
            const imagesRow = previewContainer.querySelector('.images-grid-row');

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
                                <img src="${e.target.result}" alt="Preview" class="product_image_preview w-100" style="height: 110px; object-fit: cover; display: block;">
                                <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute top-0 end-0 m-1 remove-preview-btn d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; padding: 0; font-size: 14px; z-index: 5;">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                        `;

                        col.querySelector('.remove-preview-btn').addEventListener('click', function() {
                            col.remove();
                            if (previewContainer.querySelectorAll('.product-img-wrap').length === 0) {
                                previewContainer.classList.add('d-none');
                                uploadMsg.classList.remove('d-none');
                                productImagesInput.value = ""; 
                            }
                        });

                        imagesRow.appendChild(col);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                if (previewContainer.querySelectorAll('.product-img-wrap').length === 0) {
                    uploadMsg.classList.remove('d-none');
                    previewContainer.classList.add('d-none');
                }
            }
        });
    }

});

document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById('variants-body');
    const template = document.getElementById('variant-template');
    const addBtn = document.getElementById('add-variant-btn');
    
    // جعل العداد يبدأ بعدد الصفوف المعروضة فعلياً (سواء من الـ old أو الداتابيز)
    let rowCount = tableBody.querySelectorAll('.variant-row').length;

    function updateColorCircle(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        if (selectedOption) {
            const hexColor = selectedOption.getAttribute('data-hex') || '#000000';
            const circle = selectElement.closest('td').querySelector('.color-preview-circle');
            if (circle) {
                circle.style.backgroundColor = hexColor;
            }
        }
    }

    // تلوين الدوائر لكل الصفوف القديمة المطبوعة عند تحميل الصفحة فوراً
    tableBody.querySelectorAll('.color-selector').forEach(select => {
        updateColorCircle(select);
    });

    if (addBtn && tableBody && template) {
        addBtn.addEventListener('click', function () {
            const content = template.innerHTML.replace(/__index__/g, rowCount);
            const newRow = document.createElement('tr');
            newRow.innerHTML = content;
            tableBody.appendChild(newRow);

            const newSelect = newRow.querySelector('.color-selector');
            if (newSelect) {
                updateColorCircle(newSelect);
            }

            rowCount++;
        });

        tableBody.addEventListener('change', function (e) {
            if (e.target.classList.contains('color-selector')) {
                updateColorCircle(e.target);
            }
        });

        tableBody.addEventListener('click', function (e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    }
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