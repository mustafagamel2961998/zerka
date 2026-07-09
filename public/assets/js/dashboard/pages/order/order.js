
document.addEventListener("DOMContentLoaded", function() {
    const tableElement = document.getElementById("my-order-html-table");
   
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
            }).render(document.getElementById("table-order-gridjs"));
        }
});

document.addEventListener('DOMContentLoaded', function() {
    const statusButtons = document.querySelectorAll('.status-update-btn');
    const form = document.getElementById('update-status-form');
    const statusInput = document.getElementById('form-status-input');

    statusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedStatus = this.getAttribute('data-status');

            // رسالة تأكيد سريعة تظهر للمدير قبل التحديث
            if (confirm('هل أنت متأكد من تغيير حالة هذا الطلب؟')) {
                statusInput.value = selectedStatus;
                form.submit();
            }
        });
    });
});