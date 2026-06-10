
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