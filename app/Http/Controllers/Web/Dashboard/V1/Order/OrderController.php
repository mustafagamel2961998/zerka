<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\V1\Order\UpdateOrderRequest;
use App\Actions\Dashboard\V1\Order\UpdateAction;
use App\DTOs\Dashboard\V1\Order\UpdateDTO;
class OrderController extends Controller
{
    public function __construct(private OrderRepositoryInterface $order_repository_interface){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->order_repository_interface->getPaginated();
        return view('dashboard.order.index',compact('orders'));
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
        $order = $this->order_repository_interface->findById($id);
        return view('dashboard.order.show',compact('order'));
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
    public function update(UpdateOrderRequest $request, string $id,UpdateAction $update_action)
    {
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute($dto);
        return redirect()->back()->with('success', __('crud.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
