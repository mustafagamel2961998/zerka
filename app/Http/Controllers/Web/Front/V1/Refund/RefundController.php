<?php

namespace App\Http\Controllers\Web\Front\V1\Refund;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refund;
use App\Enums\Refund\RefundStatus;
class RefundController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_item_id' => 'required|exists:order_items,id',
            'quantity'       => 'required|integer|min:1',
            'reason'         => 'required|string|max:500',
        ]);

        $item = \App\Models\OrderItem::with('refunds')->findOrFail($validated['order_item_id']);

        // تأكيد إن العنصر ده تابع لطلب بتاع نفس العميل
        // abort_unless($item->order->user_id === auth()->id(), 403);

        if ($validated['quantity'] > $item->refundable_quantity) {
            return back()->withErrors([
                'quantity' => __('front.refund_quantity_exceeds_available'),
            ])->withInput();
        }

        Refund::create([
            'order_id'      => $item->order_id,
            'order_item_id' => $item->id,
            'quantity'      => $validated['quantity'],
            'reason'        => $validated['reason'],
            'status'        => RefundStatus::PENDING,
        ]);

        return back()->with('success', __('crud.created'));
    }
}
