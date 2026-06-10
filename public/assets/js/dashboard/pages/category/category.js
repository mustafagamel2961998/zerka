
document.addEventListener("DOMContentLoaded", function() {
    const tableElement = document.getElementById("my-category-html-table");
    
    if (tableElement) {
        new gridjs.Grid({
            from: tableElement, 
            sort: true,
            // search: true
        }).render(document.getElementById("table-category-gridjs"));
    }
});