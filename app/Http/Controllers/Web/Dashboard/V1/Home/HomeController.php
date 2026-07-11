<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
class HomeController extends Controller
{
    public function __construct(private OrderRepositoryInterface $order_repository_interface){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->order_repository_interface->baseQuery()
                                                   ->whereDate('created_at', today())
                                                   ->with('items','user')
                                                   ->withCount('items')
                                                   ->get();
        $orderCount = $this->order_repository_interface->baseQuery()->count();
        $productCount = Product::count();
        $userCount = User::count(); 
        $categoryCount = Category::count();                               
        return view('dashboard.home.index',compact(
        'orders',
        'orderCount',
        'productCount',
        'userCount',
        'categoryCount'));
    }

    public function getChartData(Request $request)
    {
        $filter = $request->get('filter', '1Y'); // الافتراضي سنة
        
        // بنبدأ بالـ baseQuery ونضيف شرط الحالة 'completed' مباشرة
        $query = $this->order_repository_interface->baseQuery()
                                                ->where('status', 'completed'); // 💡 الفلترة هنا تضمن الحساب الصحيح لكل الحالات القادمة

        // تطبيق فلتر التاريخ بناءً على الزر المضغوط
        if ($filter === '1M') {
            $query->where('created_at', '>=', now()->subMonth());
            // التجميع باليوم
            $query->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(grand_total) as total'));
        } elseif ($filter === '6M') {
            $query->where('created_at', '>=', now()->subMonths(6));
            // التجميع بالشهر والسنة
            $query->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('SUM(grand_total) as total'));
        } elseif ($filter === '1Y') {
            $query->where('created_at', '>=', now()->subYear());
            // التجميع بالشهر والسنة
            $query->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('SUM(grand_total) as total'));
        } else {
            // الكل (ALL) - التجميع بالشهر والسنة
            $query->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'), DB::raw('SUM(grand_total) as total'));
        }

        $salesData = $query->groupBy('date')
                        ->orderBy('date', 'asc')
                        ->get();

        // تنسيق البيانات لتناسب ApexCharts
        $categories = $salesData->pluck('date')->toArray();
        $totals = $salesData->pluck('total')->map(fn($val) => (float)$val)->toArray();

        return response()->json([
            'categories' => $categories,
            'totals'     => $totals
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
