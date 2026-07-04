document.addEventListener('DOMContentLoaded', function () {
    
    // 1. تعريف العناصر الأساسية للمقاسات، الألوان، السعر والكمية
    const sizeInputs = document.querySelectorAll('.size-radio-input');
    const currentPriceEl = document.getElementById('currentProductPrice');
    const colorContainer = document.getElementById('colorSelectorContainer');
    const colorsList = colorContainer ? colorContainer.querySelector('.id-colors-list') : null;
    
    const qtyInput = document.getElementById('productQuantity');
    const btnPlus = document.querySelector('.btn-qty-plus');
    const btnMinus = document.querySelector('.btn-qty-minus');
    const addToCartBtn = document.querySelector('.btn-black'); // زر الإضافة للسلة

    // دالة لتحديث الحد الأقصى للكمية بناءً على الحجم المختار
    function updateMaxQuantity(checkedRadio) {
        if (checkedRadio && qtyInput) {
            // جلب الكمية المتاحة من الـ data attribute
            const maxQty = parseInt(checkedRadio.getAttribute('data-quantity'), 10) || 0;
            
            // تعيين الحد الأقصى لحقل الإدخال
            qtyInput.max = maxQty;

            // إذا كانت الكمية الحالية أكبر من المتاح للحجم الجديد، نزلها للمتاح
            let currentVal = parseInt(qtyInput.value, 10) || 1;
            if (currentVal > maxQty) {
                qtyInput.value = maxQty > 0 ? maxQty : 0; 
            }
            
            // لو الكمية المتاحة 0، صفر الحقل
            if (maxQty === 0) {
                qtyInput.value = 0;
            } else if (currentVal === 0 && maxQty > 0) {
                qtyInput.value = 1; // إعادة تعيين لـ 1 لو كان متصفر ورجع فيه كمية
            }

            // تحديث حالة زر إضافة إلى السلة
            if (addToCartBtn) {
                if (maxQty === 0) {
                    addToCartBtn.disabled = true;
                    addToCartBtn.innerText = "Out of Stock";
                } else {
                    addToCartBtn.disabled = false;
                    addToCartBtn.innerText = "Add to Cart";
                }
            }
        }
    }

    // 2. الـ Event الموحد لكل مقاس (يغير السعر، الألوان، والكمية المتاحة)
    sizeInputs.forEach(input => {
        input.addEventListener('change', function () {
            
            // --- أ) تحديث الكمية القصوى وزر السلة ---
            updateMaxQuantity(this);

            // --- ب) تحديث السعر ---
            const price = this.getAttribute('data-price');
            const currency = this.getAttribute('data-currency');

            if (price && currentPriceEl) {
                currentPriceEl.innerText = `${price} ${currency}`;
            }

            // --- ج) تحديث الألوان المربوطة بالمقاس ---
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

    // 3. تشغيل التغيير تلقائياً لأول مقاس عند فتح الصفحة ليظهر سعره وألوانه وكميته فوراً
    const activeSize = document.querySelector('.size-radio-input:checked');
    if (activeSize) {
        activeSize.dispatchEvent(new Event('change'));
    }

    // 4. منطق أزرار التحكم في الكمية مع احترام الـ max (مرة واحدة فقط)
    if (qtyInput && btnPlus && btnMinus) {
        btnPlus.addEventListener('click', function (e) {
            e.preventDefault();
            let currentVal = parseInt(qtyInput.value, 10) || 0;
            let maxVal = parseInt(qtyInput.max, 10) || 0;

            // زيادة الكمية بمقدار 1 فقط إذا لم تتجاوز الحد الأقصى
            if (currentVal < maxVal) {
                qtyInput.value = currentVal + 1;
            }
        });

        btnMinus.addEventListener('click', function (e) {
            e.preventDefault();
            let currentVal = parseInt(qtyInput.value, 10) || 0;
            // النزول بالكمية بمقدار 1 بشرط ألا تقل عن 1
            if (currentVal > 1) {
                qtyInput.value = currentVal - 1;
            }
        });
    }

    // 5. منطق معرض الصور المطور (Event Delegation)
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
});