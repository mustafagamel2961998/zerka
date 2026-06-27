<?php

namespace App\Repositories\Eloquent\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
use App\Models\Order;
class OrderEloquentRepository implements OrderRepositoryInterface
{
    public function __construct()
    {

    }
    public function getPaginated($perPage = null) : LengthAwarePaginator
    {
        return Order::select(
                'id,
                user_id,
                order_number,
                grand_total,
                coupon_code,
                created_at,
                payment_status,
                status')->with([
                        'user'=>fn($q)=>$q->with('profile:user_id,first_name,last_name','media')
                    ])->withCount('items')
                    ->latest()
                    ->paginate($perPage ?? 20);
    }

    public function findById($id) : Order
    {
        return Order::with([
                            'items'=>fn($q)=>$q->with('product.currentTranslation:id,product_id,name','product.media'),
                            'user'=>fn($q)=>$q->with('profile:user_id,first_name,last_name','media')
                          ])->findOrFail($id);
    }
}