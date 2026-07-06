<?php

namespace App\Http\Controllers\Web\Front\V1\Checkout;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Cart\CartRepositoryInterface;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(private CartRepositoryInterface $cart_repository_interface){}

    public function index(){
        $cart = $this->cart_repository_interface->findUserCart(auth()->user());
        return view('front.checkout.index', compact('cart'));
    }
}
