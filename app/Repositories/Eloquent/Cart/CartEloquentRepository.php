<?php

namespace App\Repositories\Eloquent\Cart;
use App\Repositories\Contracts\Cart\CartRepositoryInterface;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
class CartEloquentRepository implements CartRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function store(array $data)
    {
       

    }
    public function findUserCart(User $user){
        return Cart::with('items.product.media')->where('user_id', $user->id)->first();
    }
    public function createCart(User $user) : Cart{
        return Cart::create([
            'user_id' => $user->id
        ]);
    }
    public function addItemToCart(array $data) {
        $productVariant = ProductVariant::find($data['variant_id']);
        $variantColor = $productVariant->colors()->find($data['variant_color_id']);
        $getCart = $this->findUserCart(auth()->user());
        $item = CartItem::updateOrCreate([
            'cart_id' =>$data['cart_id'],
            'product_id' => $productVariant->product_id,
            'variant_color_id' => $data['variant_color_id']
        ],[
            'size' => $productVariant->size->size,
            'color' => $variantColor->color->code,
            'quantity' => $data['quantity'],
            'price' => $productVariant->price,
            'total' => $productVariant->price * $data['quantity']
        ]);
        $getCart->update([
           'subtotal' => $getCart->items()->sum('total')
        ]);

        return[
            'count'=>$getCart->items()->count(),
            'subtotal_formatted'=>format_currency($getCart->subtotal, current_currency_code()),
            'id'=>$item->id,
            'product_name'=>$productVariant->product->currentTranslation->name,
            'product_image'=>$productVariant->product->getFirstMediaUrl('images', 'thumb'),
            'size'=>$productVariant->size->size,
            'color'=>$variantColor->color->code,
            'quantity'=>$data['quantity'],
            'line_total_formatted'=>format_currency($productVariant->price * $data['quantity'],current_currency_code()),
        ];

    }

    public function destroy($id){
        $item = CartItem::find($id);

        if (!$item) {
            return null;
        }

        $cartId = $item->cart_id;
        
        $item->delete();

        $cart = Cart::with('items.product')->find($cartId);
        
        if ($cart) {
            $cart->update([
                'subtotal' => $cart->items->sum('total')
            ]);
        }

        return $cart;
    }

}