<?php

namespace App\Repositories\Eloquent\Checkout;
use App\Repositories\Contracts\Checkout\CheckoutRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Services\Dashboard\Media\MediaService;
use App\Repositories\Contracts\Cart\CartRepositoryInterface;
class CheckoutEloquentRepository implements CheckoutRepositoryInterface
{
    public function __construct()
    {
        //
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create($data);
            $this->addOrderItems($order, $data['items']);
            $this->addOrderAddress($order,$data['shipping_address']);
            $transaction = $order->transactions()->create([
                'amount' => $order->grand_total,
                'currency' => current_currency_code(),
            ]);
            MediaService::singleFileUpload($transaction, 'screenshot', $data['screen_shot']);
            return $order;
        });
    }

    private function addOrderItems($order, $items){
        foreach($items as $item){
            $order->items()->create([
                'product_id' => $item['product_id'],
                'variant_color_id' => $item['variant_color_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['total'],
                'attributes' => [
                    'size' => $item['size'],
                    'color' => $item['color'],
                ],
            ]);
        }
    }

    private function addOrderAddress($order,$address){
        return $order->address()->create($address);
    }

}