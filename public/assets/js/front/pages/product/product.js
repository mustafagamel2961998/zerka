document.addEventListener('DOMContentLoaded', function () {

    // 1. منطق معرض الصور المطور (Event Delegation)
    // تم التعديل ليعمل بالـ Delegation لضمان لقط الـ clicks حتى لو الصور قادمة بشكل ديناميكي كامل
    const mainImg = document.getElementById('mainProductImage');
    const thumbnailContainer = document.querySelector('.product-thumbnails');

    if (thumbnailContainer) {
        thumbnailContainer.addEventListener('click', function (e) {
            const clickedThumb = e.target.closest('.thumbnail-trigger');
            if (!clickedThumb) return;

            // تحديث سورس الصورة الرئيسية
            mainImg.src = clickedThumb.src;

            // إزالة وتعيين كلاس النشاط (Active) لجميع الصور داخل الحاوية
            thumbnailContainer.querySelectorAll('.thumbnail-trigger').forEach(t => t.classList.remove('active'));
            clickedThumb.classList.add('active');
        });
    }

    // 2. منطق المقاسات والألوان المرتبط بالباك إيند
    const mockColorsData = {
        'S': [{ id: 'c1', name: 'Black', code: '#000000' }, { id: 'c2', name: 'Beige', code: '#f5f5dc' }],
        'M': [{ id: 'c1', name: 'Black', code: '#000000' }, { id: 'c3', name: 'White', code: '#ffffff' }, { id: 'c4', name: 'Navy', code: '#000080' }],
        'L': [{ id: 'c2', name: 'Beige', code: '#f5f5dc' }, { id: 'c4', name: 'Navy', code: '#000080' }],
        'XL': [{ id: 'c1', name: 'Black', code: '#000000' }, { id: 'c3', name: 'White', code: '#ffffff' }]
    };

    const sizeInputs = document.querySelectorAll('.size-radio-input');
    const colorContainer = document.getElementById('colorSelectorContainer');
    const colorsList = colorContainer ? colorContainer.querySelector('.id-colors-list') : null;

    sizeInputs.forEach(input => {
        input.addEventListener('change', function () {
            const selectedSize = this.value;
            const availableColors = mockColorsData[selectedSize] || [];

            if (!colorsList) return;
            colorsList.innerHTML = '';

            if (availableColors.length > 0) {
                colorContainer.classList.remove('d-none');

                availableColors.forEach((color, index) => {
                    const checkedAttr = index === 0 ? 'checked' : '';
                    colorsList.innerHTML += `
                                    <div>
                                        <input type="radio" name="product_color" id="color_${color.id}" value="${color.id}" ${checkedAttr}>
                                        <label for="color_${color.id}" class="d-inline-block rounded-circle color-badge border border-secondary" 
                                               style="background-color: ${color.code}; width: 28px; height: 28px;" 
                                               title="${color.name}"></label>
                                    </div>
                                `;
                });
            } else {
                colorContainer.classList.add('d-none');
            }
        });
    });

    // 3. حل مشكلة أزرار التحكم في الكمية (تحديث الـ DOM بالشكل الصحيح)
    const qtyInput = document.getElementById('productQuantity');
    const btnPlus = document.querySelector('.btn-qty-plus');
    const btnMinus = document.querySelector('.btn-qty-minus');

    if (qtyInput && btnPlus && btnMinus) {
        btnPlus.addEventListener('click', function (e) {
            e.preventDefault();
            qtyInput.value = parseInt(qtyInput.value, 10) + 1;
        });

        btnMinus.addEventListener('click', function (e) {
            e.preventDefault();
            let currentVal = parseInt(qtyInput.value, 10);
            if (!isNaN(currentVal) && currentVal > 1) {
                qtyInput.value = currentVal - 1;
            }
        });
    }
});