document.addEventListener('DOMContentLoaded', function () {
    
    // 1. تعريف العناصر الأساسية للمقاسات، الألوان والسعر
    const sizeInputs = document.querySelectorAll('.size-radio-input');
    const currentPriceEl = document.getElementById('currentProductPrice');
    const colorContainer = document.getElementById('colorSelectorContainer');
    const colorsList = colorContainer ? colorContainer.querySelector('.id-colors-list') : null;

  
    // 2. الـ Event الموحد لكل مقاس (يغير السعر ويعرض الألوان في نفس الوقت)
    sizeInputs.forEach(input => {
        input.addEventListener('change', function () {
            
            // --- أ) تحديث السعر ---
            const price = this.getAttribute('data-price');
            const currency = this.getAttribute('data-currency');

            if (price && currentPriceEl) {
                currentPriceEl.innerText = `${price}`;
            }

            // --- ب) تحديث الألوان المربوطة بالمقاس ---
            if (!colorsList) return;
            colorsList.innerHTML = ''; // تفريغ الألوان القديمة

            let availableColors = [];
            try {
                availableColors = JSON.parse(this.getAttribute('data-colors')) || [];
            } catch (e) {
                console.error("Error parsing colors data", e);
            }

            // التأكد إذا كان هناك ألوان متاحة
            if (availableColors && (Array.isArray(availableColors) ? availableColors.length > 0 : Object.keys(availableColors).length > 0)) {
                colorContainer.classList.remove('d-none');

                // تحويلها لمصفوفة لو كانت جاية كـ Object مفرد
                const colorsArray = Array.isArray(availableColors) ? availableColors : [availableColors];

                colorsArray.forEach((color, index) => {
                    const checkedAttr = index === 0 ? 'checked' : '';
                    
                    // هنا تم استخدام color.color.code بناءً على الكود الخاص بك
                    const colorId = color.id || index;
                    const colorCode = color.color ? color.color.code : (color.code || '#000');
                    const colorName = color.color ? color.color.name : (color.name || '');

                    colorsList.innerHTML += `
                        <div>
                            <input type="radio" name="color" id="color_${colorId}" value="${colorCode}" ${checkedAttr}>
                            <label for="color_${colorId}" class="d-inline-block rounded-circle color-badge border border-secondary" 
                                style="background-color: ${colorCode}; width: 28px; height: 28px; cursor: pointer;" 
                                title="${colorName || colorCode}"></label>
                        </div>
                    `;
                });
            } else {
                colorContainer.classList.add('d-none');
            }
        });
    });

    // 3. تشغيل التغيير تلقائياً لأول مقاس عند فتح الصفحة ليظهر سعره وألوانه فوراً
    const activeSize = document.querySelector('.size-radio-input:checked');
    if (activeSize) {
        activeSize.dispatchEvent(new Event('change'));
    }

    // 4. منطق معرض الصور المطور (Event Delegation)
    const mainImg = document.getElementById('mainProductImage');
    const thumbnailContainer = document.querySelector('.product-thumbnails');

    if (thumbnailContainer && mainImg) {
        thumbnailContainer.addEventListener('click', function (e) {
            const clickedThumb = e.target.closest('.thumbnail-trigger');
            if (!clickedThumb) return;

            mainImg.src = clickedThumb.src;

            thumbnailContainer.querySelectorAll('.thumbnail-trigger').forEach(t => t.classList.remove('active'));
            clickedThumb.classList.add('active');
        });
    }

    // 5. منطق أزرار التحكم في الكمية
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