<?php

namespace App\Http\Controllers\Web\Front\V1\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
class OrderController extends Controller
{
    public function __construct(private OrderRepositoryInterface $order_repository_interface){}

    public function show($id)
    {
        // abort_unless($order->user_id === auth()->id(), 403);
        $order = $this->order_repository_interface->findById($id);
        return view('front.order.show', compact('order'));
    }
}
