<?php

namespace App\Repositories\Eloquent\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Enums\Order\Status;
use App\Services\Invoice\InvoiceService;
use App\Enums\Order\PyamentStatus;
use Illuminate\Database\Eloquent\Builder;
class OrderEloquentRepository implements OrderRepositoryInterface
{
    public function __construct(){}
    public function baseQuery() : Builder
    {
        return Order::query();
    }
    public function getPaginated($perPage = null) : LengthAwarePaginator
    {
        return Order::select([
                            'id', 
                            'user_id', 
                            'order_number', 
                            'grand_total', 
                            'coupon_code', 
                            'created_at', 
                            'payment_status', 
                            'status'
                        ])->with([
                        'user'=>fn($q)=>$q->with('profile:user_id,first_name,last_name','media')
                    ])->withCount('items')
                    ->latest()
                    ->paginate($perPage ?? 20);
    }

    public function findById($id) : Order
    {
        return Order::with(['activities'=>fn($q)=>$q->latest()->with([
                                'user'=>fn($q)=>$q->with('profile:user_id,first_name,last_name')
                            ]),
                            'items'=>fn($q)=>$q->with('product.currentTranslation:id,product_id,name','product.media','refunds','color.color'),
                            'user'=>fn($q)=>$q->with('profile:user_id,first_name,last_name','media'),
                            'address'
                          ])->findOrFail($id);
    }
   
    public function update(array $data)
    {
        $order = $this->findById($data['id']);
        $newStatus = Status::from($data['status']);
        $updatedOrder = DB::transaction(function () use ($order, $newStatus) {

            $order = Order::whereKey($order->id)->lockForUpdate()->first();


            if ($newStatus->value === Status::PROCESSING->value && is_null($order->stock_deducted_at)) {
                    $this->decrementInventory($order);
            }
            if ($newStatus->value === Status::PACKED->value && !$order->invoice_created) {
                    $this->createInvoice($order);
            }

            if ($newStatus->value === Status::CANCELLED->value && !is_null($order->stock_deducted_at)) {
                    $this->incrementInventory($order);
            }
            if ($newStatus->value === Status::COMPLETED->value && !is_null($order->stock_deducted_at)) {
                    $this->setPaymentStatus($order);
            }
            $order->update(['status' => $newStatus]);
            $order->items()->update(['status' => $newStatus]);
            return $order->fresh();
        });

        return $updatedOrder;
    }

    private function decrementInventory(Order $order){
        foreach ($order->items as $item) {
            $inventory = $item->color->inventory()->lockForUpdate()->first();
            $inventory->decrement('quantity', $item->quantity);
        }
        $order->update(['stock_deducted_at' => now()]);
    }
    private function createInvoice(Order $order){
         InvoiceService::orderInvoice($order);    
         $order->update(['invoice_created' => true]);
    }
    private function incrementInventory(Order $order){
        foreach ($order->items as $item) {
                $inventory = $item->color->inventory()->lockForUpdate()->first();
                $inventory->increment('quantity', $item->quantity);
            }
        $order->update(['stock_deducted_at' => null]);
    }
    private function setPaymentStatus(Order $order){
        $order->update(['payment_status' => PyamentStatus::PAID]);
    }
}