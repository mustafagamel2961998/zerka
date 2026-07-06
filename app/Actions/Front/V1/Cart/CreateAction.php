<?php

namespace App\Actions\Front\V1\Cart;
use App\DTOs\Front\V1\Cart\CreateDTO;
use App\Repositories\Contracts\Cart\CartRepositoryInterface;
class CreateAction
{
    public function __construct(private CartRepositoryInterface $cart_repository_interface){}

    public function execute(CreateDTO $data)
    {
      $cart = $this->cart_repository_interface->findUserCart(auth()->user());
      
      if (!$cart) {
          $cart = $this->cart_repository_interface->createCart(auth()->user());
      }
      
      $itemData = $data->toArray();
      
      $itemData['cart_id'] = $cart->id;
      
      return $this->cart_repository_interface->addItemToCart($itemData);
    }
}