<?php

namespace App\Services\Invoice;

class InvoiceService
{
    public static function orderInvoice($order){
        $order->invoice()->create([
            'user_id' => $order->user_id,
            'subtotal' => $order->subtotal,
            'tax_total' => $order->tax_total,
            'shipping_total' => $order->shipping_total,
            'discount_total' => $order->discount_total,
            'grand_total' => $order->grand_total,
        ]);

        // invoice_created
    }
}