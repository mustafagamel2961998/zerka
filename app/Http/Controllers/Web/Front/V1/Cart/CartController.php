<?php

namespace App\Http\Controllers\Web\Front\V1\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Front\V1\Cart\CartRequest;
use App\Actions\Front\V1\Cart\CreateAction;
use App\DTOs\Front\V1\Cart\CreateDTO;
use App\Repositories\Contracts\Cart\CartRepositoryInterface;

class CartController extends Controller
{
    public function __construct(private CartRepositoryInterface $cart_repository_interface)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request,CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $item = $create_action->execute($dto);
 
        return response()->json([
            "success"=> true,
            "message"=> __('front.add_to_cart_successfully'),
            "cart"=> [
                "count"=> $item['count'],
                "subtotal_formatted"=> $item['subtotal_formatted'],
                "items"=> [
                        [
                            "id" => $item['id'],
                            "product_name" => $item['product_name'],
                            "product_image" => $item['product_image'],
                            "size" => $item['size'],
                            "color" => $item['color'],
                            "quantity" => $item['quantity'],
                            "line_total_formatted" => $item['line_total_formatted'],
                        ],
                    ]
                ]
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = $this->cart_repository_interface->destroy($id);

        if (!$cart) {
            return response()->json([
                'success' => false, 
                'message' => __('front.item_not_found') ?? 'العنصر غير موجود'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'cart' => [
                'count' => $cart->items->count(),
                'subtotal_formatted' => format_currency($cart->subtotal, current_currency_code()),
                'items' => $cart->items->map(function($i) {
                    return [
                        'id' => $i->id,
                        'product_name' => $i->product->name ?? '',
                        'product_image' => $i->product->getFirstMediaUrl('images', 'thumb'),
                        'quantity' => $i->quantity,
                        'color' => $i->color,
                        'size' => $i->size,
                        'line_total_formatted' => format_currency($i->total, current_currency_code()),
                    ];
                })
            ]
        ]);
    }
}
