document.addEventListener('DOMContentLoaded', function () {
    const payCodRadio = document.getElementById('pay_cod');
    const payWalletRadio = document.getElementById('pay_wallet');
    const walletDetailsContainer = document.getElementById('walletDetailsContainer');

    // دالة التحكم في إظهار أو إخفاء حقل لقطة الشاشة ورقم الموبايل
    function togglePaymentDetails() {
        if (payWalletRadio && payWalletRadio.checked) {
            walletDetailsContainer.classList.remove('d-none');
            document.getElementById('screenshotInput').setAttribute('required', 'required');
            payWalletRadio.closest('.payment-option-wrapper').classList.add('bg-light-subtle');
            payCodRadio.closest('.payment-option-wrapper').classList.remove('bg-light-subtle');
        } else {
            walletDetailsContainer.classList.add('d-none');
            document.getElementById('screenshotInput').removeAttribute('required');
            payCodRadio.closest('.payment-option-wrapper').classList.add('bg-light-subtle');
            payWalletRadio.closest('.payment-option-wrapper').classList.remove('bg-light-subtle');
        }
    }

    if (payCodRadio && payWalletRadio) {
        payCodRadio.addEventListener('change', togglePaymentDetails);
        payWalletRadio.addEventListener('change', togglePaymentDetails);
    }

    // تأثير تغيير الخلفية عند تبديل بطاقات العناوين
    const addressRadios = document.querySelectorAll('input[name="address_id"]');
    addressRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            addressRadios.forEach(r => r.closest('.address-card').classList.remove(
                'bg-light-subtle'));
            if (this.checked) {
                this.closest('.address-card').classList.add('bg-light-subtle');
            }
        });
    });
});