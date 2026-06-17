
document.addEventListener("DOMContentLoaded", function() {
    const tableElement = document.getElementById("my-country-html-table");
    
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
       }).render(document.getElementById("table-country-gridjs"));
    }
    
});

document.addEventListener("DOMContentLoaded", function() {
    const citytableElement = document.getElementById("my-city-html-table");

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
       }).render(document.getElementById("table-city-gridjs"));
    }
});