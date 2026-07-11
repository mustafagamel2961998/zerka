document.addEventListener("DOMContentLoaded", function () {
    let chartElement = document.querySelector("#dash-performance-chart");
    if (!chartElement) return;

    let chart;

    // إعدادات الـ ApexChart المبدئية
    let options = {
        series: [{
            name: Total_sales,
            data: [] // هتنزل هنا الـ totals من الـ Ajax
        }],
        chart: {
            type: 'area', // أو line حسب رغبتك
            height: 350,
            toolbar: { show: false }
        },
        stroke: { curve: 'smooth', width: 2 },
        colors: ['#000000'], // لون متناسق مع التصميم الأسود بتاعك
        dataLabels: { enabled: false },
        xaxis: {
            categories: [], // هتنزل هنا التواريخ من الـ Ajax
        },
        yaxis: {
            labels: {
                formatter: function (val) { return val.toFixed(2); }
            }
        },
        tooltip: { y: { formatter: function (val) { return "$" + val.toFixed(2); } } }
    };

    // إنشاء الرسم البياني فارغاً أولاً
    chart = new ApexCharts(chartElement, options);
    chart.render();

    // دالة جلب البيانات وتحديث الشارت
    function fetchChartData(filterType) {
        // حط هنا رابط الـ Route اللي عملته في لارافيل
        let url = `/dashboard/v1/sales-chart?filter=${filterType}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                // تحديث بيانات الـ Chart بدون عمل ريفريش للمتصفح
                chart.updateOptions({
                    xaxis: { categories: data.categories },
                    series: [{ data: data.totals }]
                });
            })
            .catch(error => console.error('Error fetching sales data:', error));
    }

    // جلب بيانات الفلتر الافتراضي عند فتح الصفحة (1Y)
    fetchChartData('1Y');

    // الاستماع لضغط الأزرار
    document.querySelectorAll('.chart-filter').forEach(button => {
        button.addEventListener('click', function () {
            // تغيير الزر النشط ستايل
            document.querySelectorAll('.chart-filter').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // جلب البيانات بناءً على الفلتر المختار
            let filter = this.getAttribute('data-filter');
            fetchChartData(filter);
        });
    });
});