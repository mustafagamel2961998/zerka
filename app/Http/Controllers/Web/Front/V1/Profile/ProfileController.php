<?php

namespace App\Http\Controllers\Web\Front\V1\Profile;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
class ProfileController extends Controller
{
    public function __construct(private OrderRepositoryInterface $order_repository_interface){}
    public function index()
    {
        $orders = $this->order_repository_interface->findByAuthUser(auth()->user());
        return view('front.profile.index',compact('orders'));
    }
}
