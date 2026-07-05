<?php

namespace App\Repositories\Eloquent\Variant;
use App\Repositories\Contracts\Variant\VariantRepositoryInterface;
use App\Models\Product;
class VariantEloquentRepository implements VariantRepositoryInterface
{
    

    public function store(array $variants, Product $product)
    {
        foreach ($variants as $variantData) {
            $variant = $product->variants()->create([
                'size_id' => $variantData['size_id'],
                'price'   => $variantData['price'],
                'sku'     => 10000 + $product->id . $variantData['size_id'] . 1,
            ]);

            foreach ($variantData['colors'] as $colorData) {
                $variantColor = $variant->colors()->create([
                    'color_id' => $colorData['color_id'],
                ]);

                $variantColor->inventory()->create([
                    'warehouse_id'     => $colorData['warehouse_id'],
                    'quantity'         => $colorData['quantity'],
                    'minimum_quantity' => $colorData['minimum_quantity'],
                ]);
            }
        }
    }
    
}