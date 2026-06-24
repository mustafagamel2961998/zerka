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
        return Order::latest()->paginate($perPage ?? 20);
    }
}