<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Refund;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Http\Requests\Dashboard\V1\Refund\UpdateRefundRequest;
use App\Models\Inventory;
use App\Enums\Refund\RefundStatus;
use Illuminate\Support\Facades\DB;
class RefundController extends Controller
{
    public function refund_request()
    {
        $refund_requests = Refund::with(['order.user.profile', 'item.product'])
            ->latest()
            ->paginate(20);

        return view('dashboard.order.refund-request', compact('refund_requests'));
    }

    public function update(UpdateRefundRequest $request, $id)
    {
        
        $refund = Refund::with('item.color.inventory')->findOrFail($id);
        DB::transaction(function () use ($refund, $request) {

            $inventory = $refund->item->color->inventory;

            if ($inventory) {
                Inventory::where('id', $inventory->id)
                    ->lockForUpdate()
                    ->increment('quantity', $refund->quantity);
            }

            $refund->update([
                'status' => $request->status,
            ]);

        });
        return redirect()->route('dashboard.v1.refund.request')->with('success', __('crud.updated')); 


    }
}
