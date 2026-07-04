<?php

namespace App\Repositories\Eloquent\Variant;
use App\Repositories\Contracts\Variant\VariantRepositoryInterface;
use App\Models\Product;
class VariantEloquentRepository implements VariantRepositoryInterface
{
    

    public function store(array $variants,Product $product) 
    {
        foreach ($variants as $variant) {
            $variantData = $product->variants()->create([
                'size_id'  => $variant['size_id'],
                'price'    => $variant['price'],
                'sku'      => 10000 + $product->id . $variant['size_id'] . $variant['color_id'],
            ]);
            $color = $variantData->color()->create([
                'color_id'=>$variant['color_id'],
            ]);
            $color->inventory()->create([
                'warehouse_id'     => $variant['warehouse_id'],
                'quantity'         => $variant['quantity'],
                'minimum_quantity' => $variant['minimum_quantity'],
            ]);
        }
       
    }

    
}