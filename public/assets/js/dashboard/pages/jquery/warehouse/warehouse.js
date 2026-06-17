document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('choices_country_id');
    const cityContainer = document.getElementById('city_select_container');

    // متغيرات لتخزين القيمة القديمة أو الحالية في الـ Edit
    const selectedCityId = CityId;
    // console.log(selectedCityId);
    // دالة جلب المدن
    function fetchCities(countryId, callback) {
        if (!countryId) return;

        // بناء الـ URL للـ Route بتاعك ديناميكياً
        const url = `/dashboard/v1/countries/${countryId}`;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(response => {
                if (response.status) {
                    renderCitySelect(response.data);
                    if (callback) callback();
                }
            })
            .catch(error => console.error('Error fetching cities:', error));
    }

    // دالة بناء الـ Select الخاص بالمدن
    function renderCitySelect(cities) {
        let options = `<option value="" disabled ${!selectedCityId ? 'selected' : ''}>
        ${selectCity}
        </option>`;

        cities.forEach(city => {
            // الترجمة الحالية للمدينة (تأكد من شكل الـ JSON الراجع من الـ Controller)
            const cityName = city.current_translation ? city.current_translation.name : city.name;
            const isSelected = city.id == selectedCityId ? 'selected' : '';

            options += `<option value="${city.id}" ${isSelected}>${cityName}</option>`;
        });

        // بنعيد بناء الـ select وبنحط التاج بتاع Choices.js تاني لو بتستخدمه
        cityContainer.innerHTML = `
                <select class="form-control" id="city_id" name="city_id" data-choices>
                    ${options}
                </select>
            `;

        // إعادة تشغيل مكتبة Choices.js على الـ select الجديد إذا كانت موجودة عالمياً
        if (typeof Choices !== 'undefined') {
            const element = cityContainer.querySelector('[data-choices]');
            new Choices(element, { shouldSort: false });
        }
    }

    // 1. الاستماع للتغيير عند اختيار دولة جديدة
    countrySelect.addEventListener('change', function () {
        fetchCities(this.value);
    });

    // 2. عند فتح الصفحة (لو حالة Edit أو بعد الـ Validation Error)
    if (countrySelect.value) {
        fetchCities(countrySelect.value);
    }
});