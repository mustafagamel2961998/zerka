
document.addEventListener("DOMContentLoaded", function() {
    const tableElement = document.getElementById("my-color-html-table");
    
    if (tableElement) {
        new gridjs.Grid({
            from: tableElement, 
            sort: true,
            // search: true
        }).render(document.getElementById("table-color-gridjs"));
    }
});