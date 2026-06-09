document.addEventListener('DOMContentLoaded', function () {
    const statusSwitch = document.getElementById('status');

    if (statusSwitch) {
        if (statusSwitch.checked) {
            statusSwitch.value = 'active';
        } else {
            statusSwitch.value = 'inactive';
        }
        statusSwitch.addEventListener('change', function () {
            if (this.checked) {
                this.value = 'active';
            } else {
                this.value = 'inactive';
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const tableElement = document.getElementById("my-city-html-table");
    
    if (tableElement) {
        new gridjs.Grid({
            from: tableElement, 
            sort: true,
            // search: true
        }).render(document.getElementById("table-city-gridjs"));
    }
});