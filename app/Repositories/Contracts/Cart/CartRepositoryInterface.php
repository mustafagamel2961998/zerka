<?php

namespace App\Repositories\Contracts\Cart;
use App\Models\User;
use App\Models\Cart;
interface CartRepositoryInterface
{
    public function store(array $data);
    public function findUserCart(User $user);
    public function createCart(User $user) : Cart;
    public function addItemToCart(array $data);
    public function destroy($id);
}