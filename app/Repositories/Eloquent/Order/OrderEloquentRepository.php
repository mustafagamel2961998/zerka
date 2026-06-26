<?php

namespace App\Repositories\Eloquent\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
use App\Models\Order;
class OrderEloquentRepository implements OrderRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function getPaginated($perPage = null) : LengthAwarePaginator
    {
        return Order::with(['transactions', 'user'=>fn($q)=>$q->with('profile','media')])->latest()->paginate($perPage ?? 20);
    }

    public function findById($id) : Order
    {
        return Order::with('user.profile')->findOrFail($id);
    }
}