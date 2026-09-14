<?php

namespace App\Http\Controllers\Web\Front\V1\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\V1\Checkout\CheckoutRequest;
use App\Repositories\Contracts\Cart\CartRepositoryInterface;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\Actions\Front\V1\Checkout\CreateAction;
use App\DTOs\Front\V1\Checkout\CreateDTO;
class CheckoutController extends Controller
{
    public function __construct(
        private CartRepositoryInterface $cart_repository_interface,
        private UserRepositoryInterface $user_repository_interface
    ){}

    public function index(){
        $cart = $this->cart_repository_interface->findUserCart(auth()->user());
        if(empty($cart)){
            return redirect()->route('home')->with('error', __('front.cart_empty'));
        }
        $user = $this->user_repository_interface->findById(auth()->user());
        $addresses = $user->addresses;
        return view('front.checkout.index', compact('cart','addresses'));
    }

    public function store(CheckoutRequest $request,CreateAction $create_action){
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('checkout.index')->with('success', __('front.checkout_successfully'));
    }
}
