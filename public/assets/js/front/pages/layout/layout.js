document.addEventListener('DOMContentLoaded', function () {

    const sizeInputs = document.querySelectorAll('.size-radio-input');
    const currentPriceEl = document.getElementById('currentProductPrice');
    const colorContainer = document.getElementById('colorSelectorContainer');
    const colorsList = colorContainer ? colorContainer.querySelector('.id-colors-list') : null;
    const stockStatusText = document.getElementById('stockStatusText');

    const qtyInput = document.getElementById('productQuantity');
    const btnPlus = document.querySelector('.btn-qty-plus');
    const btnMinus = document.querySelector('.btn-qty-minus');
    const addToCartBtn = document.querySelector('.btn-black');

    // ------------------------------------------------------------
    // تحديث الكمية القصوى وحالة زر السلة بناءً على "اللون" المختار
    // ------------------------------------------------------------
    function updateMaxQuantity(maxQty) {
        if (!qtyInput) return;

        qtyInput.max = maxQty;

        let currentVal = parseInt(qtyInput.value, 10) || 1;
        if (currentVal > maxQty) {
            currentVal = maxQty > 0 ? maxQty : 0;
        }
        if (maxQty === 0) {
            currentVal = 0;
        } else if (currentVal === 0) {
            currentVal = 1;
        }
        qtyInput.value = currentVal;

        if (addToCartBtn) {
            if (maxQty === 0) {
                addToCartBtn.disabled = true;
                addToCartBtn.innerText = "Out of Stock";
            } else {
                addToCartBtn.disabled = false;
                addToCartBtn.innerText = "Add to Cart";
            }
        }

        if (stockStatusText) {
            if (maxQty > 0) {
                stockStatusText.classList.remove('d-none');
                stockStatusText.innerText = `${maxQty} in stock`;
            } else {
                stockStatusText.classList.remove('d-none');
                stockStatusText.innerText = `Out of stock`;
            }
        }
    }

    // ------------------------------------------------------------
    // رسم الألوان الخاصة بالحجم المختار
    // ------------------------------------------------------------
    function renderColors(colorsArray) {
        if (!colorsList) return;
        colorsList.innerHTML = '';

        if (!colorsArray || colorsArray.length === 0) {
            colorContainer.classList.add('d-none');
            updateMaxQuantity(0);
            return;
        }

        colorContainer.classList.remove('d-none');

        colorsArray.forEach((color, index) => {
            const checkedAttr = index === 0 ? 'checked' : '';
            const isOutOfStock = (color.quantity ?? 0) <= 0;

            colorsList.innerHTML += `
                <div>
                    <input type="radio"
                        name="color"
                        id="color_${color.variant_color_id}"
                        value="${color.color_id}"
                        class="color-radio-input"
                        data-quantity="${color.quantity}"
                        ${checkedAttr}
                        ${isOutOfStock ? 'disabled' : ''}>
                    <label for="color_${color.variant_color_id}"
                        class="d-inline-block rounded-circle color-badge border border-secondary ${isOutOfStock ? 'opacity-25' : ''}"
                        style="background-color: ${color.code}; width: 28px; height: 28px; cursor: ${isOutOfStock ? 'not-allowed' : 'pointer'};"
                        title="${color.name || color.code}${isOutOfStock ? ' (Out of stock)' : ''}">
                    </label>
                </div>
            `;
        });

        // تفعيل أول لون متاح (مش بالضرورة أول عنصر لو كان أول عنصر خلص من المخزن)
        bindColorEvents();

        const firstAvailable = colorsArray.find(c => (c.quantity ?? 0) > 0) || colorsArray[0];
        updateMaxQuantity(firstAvailable ? (firstAvailable.quantity ?? 0) : 0);
    }

    // ------------------------------------------------------------
    // ربط event على الألوان بعد إعادة رسمها (لأنها بتتولد ديناميكيًا)
    // ------------------------------------------------------------
    function bindColorEvents() {
        const colorRadios = colorsList.querySelectorAll('.color-radio-input');
        colorRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                const maxQty = parseInt(this.getAttribute('data-quantity'), 10) || 0;
                updateMaxQuantity(maxQty);
            });
        });
    }

    // ------------------------------------------------------------
    // عند تغيير الحجم: السعر يتغير + الألوان تتغير + الكمية تتصفر لأول لون متاح
    // ------------------------------------------------------------
    sizeInputs.forEach(input => {
        input.addEventListener('change', function () {

            const price = this.getAttribute('data-price');
            const currency = this.getAttribute('data-currency');
            if (price && currentPriceEl) {
                currentPriceEl.innerText = `${price} ${currency}`;
            }

            let availableColors = [];
            try {
                availableColors = JSON.parse(this.getAttribute('data-colors')) || [];
            } catch (e) {
                console.error("Error parsing colors data", e);
            }

            renderColors(availableColors);
        });
    });

    // تشغيل أول حجم مختار تلقائيًا عند فتح الصفحة
    const activeSize = document.querySelector('.size-radio-input:checked');
    if (activeSize) {
        activeSize.dispatchEvent(new Event('change'));
    }

    // ------------------------------------------------------------
    // أزرار زيادة / إنقاص الكمية
    // ------------------------------------------------------------
    if (qtyInput && btnPlus && btnMinus) {
        btnPlus.addEventListener('click', function (e) {
            e.preventDefault();
            let currentVal = parseInt(qtyInput.value, 10) || 0;
            let maxVal = parseInt(qtyInput.max, 10) || 0;
            if (currentVal < maxVal) {
                qtyInput.value = currentVal + 1;
            }
        });

        btnMinus.addEventListener('click', function (e) {
            e.preventDefault();
            let currentVal = parseInt(qtyInput.value, 10) || 0;
            if (currentVal > 1) {
                qtyInput.value = currentVal - 1;
            }
        });
    }

    // ------------------------------------------------------------
    // معرض الصور
    // ------------------------------------------------------------
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

document.addEventListener('DOMContentLoaded', function () {

    // ============================================================
    // 1. تعريف العناصر الأساسية
    // ============================================================
    const sizeInputs = document.querySelectorAll('.size-radio-input');
    const currentPriceEl = document.getElementById('currentProductPrice');
    const colorContainer = document.getElementById('colorSelectorContainer');
    const colorsList = colorContainer ? colorContainer.querySelector('.id-colors-list') : null;
    const stockStatusText = document.getElementById('stockStatusText');

    const qtyInput = document.getElementById('productQuantity');
    const btnPlus = document.querySelector('.btn-qty-plus');
    const btnMinus = document.querySelector('.btn-qty-minus');
    const addToCartBtn = document.getElementById('addToCartBtn');

    if (addToCartBtn) {
        addToCartBtn.dataset.originalText = addToCartBtn.innerHTML;
    }

    // ============================================================
    // 2. تحديث الحد الأقصى للكمية وحالة زر السلة (شكليًا فقط للعرض)
    // ============================================================
    function updateMaxQuantity(maxQty) {
        if (!qtyInput) return;

        qtyInput.max = maxQty;

        let currentVal = parseInt(qtyInput.value, 10) || 1;
        if (currentVal > maxQty) {
            currentVal = maxQty > 0 ? maxQty : 0;
        }
        if (maxQty === 0) {
            currentVal = 0;
        } else if (currentVal === 0) {
            currentVal = 1;
        }
        qtyInput.value = currentVal;

        if (addToCartBtn) {
            if (maxQty === 0) {
                addToCartBtn.disabled = true;
                addToCartBtn.innerText = "Out of Stock";
            } else {
                addToCartBtn.disabled = false;
                addToCartBtn.innerHTML = addToCartBtn.dataset.originalText;
            }
        }

        if (stockStatusText) {
            stockStatusText.classList.remove('d-none');
            stockStatusText.innerText = maxQty > 0 ? `${maxQty} in stock` : `Out of stock`;
        }
    }

    // ============================================================
    // 3. رسم الألوان الخاصة بالحجم المختار (عرض بصري بس)
    // ============================================================
    function renderColors(colorsArray) {
        if (!colorsList) return;
        colorsList.innerHTML = '';

        if (!colorsArray || colorsArray.length === 0) {
            colorContainer.classList.add('d-none');
            updateMaxQuantity(0);
            return;
        }

        colorContainer.classList.remove('d-none');

        colorsArray.forEach((color, index) => {
            const checkedAttr = index === 0 ? 'checked' : '';
            const isOutOfStock = (color.quantity ?? 0) <= 0;

            colorsList.innerHTML += `
                <div>
                    <input type="radio"
                        name="color"
                        id="color_${color.variant_color_id}"
                        value="${color.variant_color_id}"
                        class="color-radio-input"
                        data-variant-color-id="${color.variant_color_id}"
                        data-quantity="${color.quantity}"
                        ${checkedAttr}
                        ${isOutOfStock ? 'disabled' : ''}>
                    <label for="color_${color.variant_color_id}"
                        class="d-inline-block rounded-circle color-badge border border-secondary ${isOutOfStock ? 'opacity-25' : ''}"
                        style="background-color: ${color.code}; width: 28px; height: 28px; cursor: ${isOutOfStock ? 'not-allowed' : 'pointer'};"
                        title="${color.name || color.code}${isOutOfStock ? ' (Out of stock)' : ''}">
                    </label>
                </div>
            `;
        });

        bindColorEvents();

        const firstAvailable = colorsArray.find(c => (c.quantity ?? 0) > 0) || colorsArray[0];
        updateMaxQuantity(firstAvailable ? (firstAvailable.quantity ?? 0) : 0);
    }

    // ============================================================
    // 4. ربط أحداث تغيير اللون (لازم تتعاد بعد كل رسم لأن العناصر جديدة)
    // ============================================================
    function bindColorEvents() {
        const colorRadios = colorsList.querySelectorAll('.color-radio-input');
        colorRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                const maxQty = parseInt(this.getAttribute('data-quantity'), 10) || 0;
                updateMaxQuantity(maxQty);
            });
        });
    }

    // ============================================================
    // 5. عند تغيير الحجم: السعر يتغير + الألوان تتغير (عرض بصري بس)
    // ============================================================
    sizeInputs.forEach(input => {
        input.addEventListener('change', function () {

            const price = this.getAttribute('data-price');
            const currency = this.getAttribute('data-currency');
            if (price && currentPriceEl) {
                currentPriceEl.innerText = `${price} ${currency}`;
            }

            let availableColors = [];
            try {
                availableColors = JSON.parse(this.getAttribute('data-colors')) || [];
            } catch (e) {
                console.error("Error parsing colors data", e);
            }

            renderColors(availableColors);
        });
    });

    // تشغيل أول حجم مختار تلقائيًا عند فتح الصفحة
    const activeSize = document.querySelector('.size-radio-input:checked');
    if (activeSize) {
        activeSize.dispatchEvent(new Event('change'));
    }

    // ============================================================
    // 6. أزرار زيادة / إنقاص كمية المنتج (قبل الإضافة للسلة)
    // ============================================================
    if (qtyInput && btnPlus && btnMinus) {
        btnPlus.addEventListener('click', function (e) {
            e.preventDefault();
            let currentVal = parseInt(qtyInput.value, 10) || 0;
            let maxVal = parseInt(qtyInput.max, 10) || 0;
            if (currentVal < maxVal) {
                qtyInput.value = currentVal + 1;
            }
        });

        btnMinus.addEventListener('click', function (e) {
            e.preventDefault();
            let currentVal = parseInt(qtyInput.value, 10) || 0;
            if (currentVal > 1) {
                qtyInput.value = currentVal - 1;
            }
        });
    }

    // ============================================================
    // 7. معرض الصور
    // ============================================================
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

    // ============================================================
    // 8. تجميع بيانات الإضافة للسلة — الـ IDs فقط، بدون سعر أو مخزون
    // ============================================================
    function collectSelectedProductData() {
        const selectedSize = document.querySelector('.size-radio-input:checked');
        const selectedColor = document.querySelector('.color-radio-input:checked');

        if (!selectedSize) {
            return { valid: false, message: 'من فضلك اختر المقاس أولاً' };
        }

        const variantId = selectedSize.getAttribute('data-variant-id');
        if (!variantId) {
            return { valid: false, message: 'حدث خطأ في تحديد المنتج' };
        }

        // لو فيه ألوان متاحة للحجم ده بس مفيش لون متحدد
        if (colorContainer && !colorContainer.classList.contains('d-none') && !selectedColor) {
            return { valid: false, message: 'من فضلك اختر اللون' };
        }

        const quantity = parseInt(qtyInput?.value, 10) || 1;

        return {
            valid: true,
            data: {
                variant_id: variantId,
                variant_color_id: selectedColor ? selectedColor.getAttribute('data-variant-color-id') : null,
                quantity: quantity,
            }
        };
    }

    // ============================================================
    // 9. إرسال الطلب لإضافة المنتج للسلة (AJAX)
    // ============================================================
    function addToCartRequest(payload) {
        if (!addToCartBtn) return;

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

        const originalHtml = addToCartBtn.innerHTML;
        addToCartBtn.disabled = true;
        addToCartBtn.innerHTML = 'Adding...';

        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify(payload)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartUI(data.cart);

                const cartOffcanvasEl = document.getElementById('cartSidebar');
                if (cartOffcanvasEl && typeof bootstrap !== 'undefined') {
                    const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(cartOffcanvasEl);
                    bsOffcanvas.show();
                }
            } else {
                alert(data.message || 'حدث خطأ أثناء الإضافة للسلة');
            }
        })
        .catch(error => {
            console.error('Add to cart error:', error);
            alert('حدث خطأ في الاتصال بالسيرفر');
        })
        .finally(() => {
            addToCartBtn.disabled = false;
            addToCartBtn.innerHTML = originalHtml;
        });
    }

    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const result = collectSelectedProductData();

            if (!result.valid) {
                alert(result.message);
                return;
            }

            addToCartRequest(result.data);
        });
    }

    // ============================================================
    // 10. تحديث واجهة السلة (Cart Offcanvas) بعد نجاح الإضافة
    // ============================================================
    // ============================================================
    // 10. تحديث واجهة السلة (Cart Offcanvas) بعد نجاح الإضافة (Realtime Append/Update)
    // ============================================================
   function updateCartUI(cart) {
    const cartTitle = document.getElementById('cartSidebarLabel');
    const itemsWrapper = document.querySelector('.cart-items-wrapper');
    const subtotalEl = document.getElementById('cartSubtotal');
    // جلب الـ Badge الخاص بالهيدر
    const cartBadgeCount = document.getElementById('cartBadgeCount'); 

    if (!itemsWrapper) return;

    // 1. تحديث عداد الـ Badge في الهيدر (Realtime)
    if (cartBadgeCount) {
        cartBadgeCount.innerText = cart.count ?? 0;
    }

    // تحديث عنوان الـ Offcanvas SideBar
    if (cartTitle) {
        const baseText = cartTitle.textContent.split('(')[0].trim();
        cartTitle.innerText = `${baseText} (${cart.count ?? 0})`;
    }

    if (subtotalEl) {
        subtotalEl.innerText = cart.subtotal_formatted ?? 'EGP 0.00';
    }

    // 2. إذا كانت السلة فارغة تماماً من السيرفر
    if (!cart.items || cart.items.length === 0) {
        itemsWrapper.innerHTML = `
            <p class="text-muted text-center py-5 my-5 small">Your cart is currently empty.</p>
        `;
        return;
    }

    // 3. إزالة رسالة "السلة فارغة" المطبوعة من الـ Blade لو كانت موجودة
    const emptyMessage = itemsWrapper.querySelector('.text-center');
    if (emptyMessage) {
        itemsWrapper.innerHTML = ''; 
    }

    // 4. المرور على المنتجات القادمة من الـ Response وتحديث الـ DOM ذكياً
    cart.items.forEach(item => {
        const existingItemRow = itemsWrapper.querySelector(`.cart-item[data-item-id="${item.id}"]`);

        if (existingItemRow) {
            const qtySpan = existingItemRow.querySelector('.input-group-text');
            const totalSpan = existingItemRow.querySelector('.fw-semibold.small');
            
            if (qtySpan) qtySpan.innerText = item.quantity;
            if (totalSpan) totalSpan.innerText = item.line_total_formatted;
        } else {
            const colorSwatch = item.color
                ? `<span class="d-inline-block rounded-circle border me-1" style="width:14px;height:14px;background-color:${item.color};"></span>`
                : '';

            const newItemHtml = `
                <div class="d-flex align-items-start gap-3 py-3 border-bottom border-light-subtle cart-item" data-item-id="${item.id}">
                    <img src="${item.product_image}" alt="${item.product_name}" class="rounded" style="width: 70px; height: 70px; object-fit: contain; flex-shrink: 0;">

                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-semibold mb-1 fs-7">${item.product_name}</h6>
                            <button type="button" class="btn btn-sm btn-link text-muted p-0 remove-cart-item" data-item-id="${item.id}">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>

                        <div class="text-muted small mb-1">
                            ${item.size ? `Size: ${item.size}` : ''}
                            ${item.color ? ` &nbsp;|&nbsp; ${colorSwatch}` : ''}
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="input-group-text">${item.quantity}</span>
                            <span class="fw-semibold small">${item.line_total_formatted}</span>
                        </div>
                    </div>
                </div>
            `;
            
            itemsWrapper.insertAdjacentHTML('beforeend', newItemHtml);
        }
    });
}



    // ============================================================
    // 11. حذف منتج من السلة (Realtime Delete + DOM Removal)
    // ============================================================
    const itemsWrapper = document.querySelector('.cart-items-wrapper');

    if (itemsWrapper) {
        itemsWrapper.addEventListener('click', function (e) {
            // التحقق من أن العنصر الذي تم الضغط عليه هو زر الحذف أو الأيقونة التي بداخله
            const removeBtn = e.target.closest('.remove-cart-item');
            if (!removeBtn) return;

            e.preventDefault();

            // جلب الـ ID الخاص بالـ Item
            const itemId = removeBtn.getAttribute('data-item-id');
            const cartItemRow = removeBtn.closest('.cart-item');

            if (!itemId || !cartItemRow) return;

            // توفير الـ CSRF Token من الـ Meta tag
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';

            // تعطيل الزر مؤقتاً أثناء الإرسال
            removeBtn.disabled = true;

            // إرسال طلب الحذف للـ Backend
            fetch(`/cart/item/destroy/${itemId}`, {
                method: 'DELETE', // أو POST حسب تصميم الـ Route عندك، ويفضل DELETE
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // تأثير حركي ناعم للاختفاء قبل المسح النهائي من الـ DOM
                    cartItemRow.style.transition = 'all 0.3s ease';
                    cartItemRow.style.opacity = '0';
                    cartItemRow.style.transform = 'translateX(30px)';

                    setTimeout(() => {
                        cartItemRow.remove(); // مسح العنصر تماماً من المتصفح

                        // تحديث الإجمالي والعداد بناءً على البيانات الجديدة القادمة من السيرفر
                        if (data.cart) {
                            updateCartUI(data.cart);
                        }
                    }, 300);

                } else {
                    alert(data.message || 'حدث خطأ أثناء حذف المنتج');
                    removeBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Delete item error:', error);
                alert('حدث خطأ في الاتصال بالسيرفر');
                removeBtn.disabled = false;
            });
        });
    }

});