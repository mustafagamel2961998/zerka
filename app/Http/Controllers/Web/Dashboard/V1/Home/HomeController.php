<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;

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
        return view('dashboard.home.index',compact('orders'));
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
