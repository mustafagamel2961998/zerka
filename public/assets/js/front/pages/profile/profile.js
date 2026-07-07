document.addEventListener('DOMContentLoaded', function () {

    // دالة عامة تجيب المدن بناءً على الدولة
    async function loadCities(countryId, citySelect, selectedCityId = null) {
        citySelect.innerHTML = `<option value="" disabled selected>${selectCity}</option>`;
        if (!countryId) return;

        try {
            const response = await fetch(`/countries/show/${countryId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const result = await response.json();

            if (result.status) {
                result.data.forEach(city => {
                    console.log(city);
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.current_translation?.name;
                    if (selectedCityId && city.id == selectedCityId) {
                        option.selected = true;
                    }
                    citySelect.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Error loading cities:', error);
        }
    }

    // ---- فورم الإضافة ----
    const addCountrySelect = document.getElementById('country_id');
    const addCitySelect = document.getElementById('city_id');

    addCountrySelect.addEventListener('change', function () {
        loadCities(this.value, addCitySelect);
    });

    // ---- فورم التعديل ----
    const editCountrySelect = document.getElementById('edit_country_id');
    const editCitySelect = document.getElementById('edit_city_id');
    const editForm = document.getElementById('editAddressForm');

    editCountrySelect.addEventListener('change', function () {
        loadCities(this.value, editCitySelect);
    });

    document.querySelectorAll('.edit-address-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const addressId = this.dataset.id;

            document.getElementById('edit_name').value = this.dataset.name;
            document.getElementById('edit_phone').value = this.dataset.phone;
            document.getElementById('edit_street_details').value = this.dataset.streetDetails;
            editCountrySelect.value = this.dataset.countryId;

            // نحمّل مدن الدولة المختارة، ونحدد المدينة الصح بعد ما توصل
            loadCities(this.dataset.countryId, editCitySelect, this.dataset.cityId);

            // ضبط الـ action الخاص بالـ update route
            editForm.action = `/addresses/${addressId}`;
        });
    });

});