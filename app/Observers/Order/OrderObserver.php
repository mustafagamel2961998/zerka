<?php

namespace App\Observers\Order;

use App\Models\Order;
use Illuminate\Support\Carbon;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function creating(Order $order): void
    {
        $order->order_number = OrderObserver::getNextOrderNumber();
    }

    private static function getNextOrderNumber(){
        $year = Carbon::now()->year;

        $orderNumber = Order::whereYear('created_at', $year)->max('order_number');
        if($orderNumber){
            return $orderNumber +1;
        }   

        return $year . '0001';
    }
}
