<?php

namespace App\Observers\Product;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function creating(Product $product)
    {
        $prefix = $product->category->translations()->where('locale', 'en')->first()->name;
        $datePart = date('Y'); 
        
        $nextSerialNumber = Product::where('category_id', $product->category_id)->count() + 1;
        $serial = str_pad($nextSerialNumber, 3, '0', STR_PAD_LEFT);

        $product->code = "{$prefix}-{$datePart}-{$serial}";

    }
    public function updating(Product $product)
    {
        // if ($product->isDirty('category_id')) {
        //     $prefix =  $product->category->translations()->where('locale', 'en')->first()->name;
        //     $datePart = date('Y'); 
            
        //     $nextSerialNumber = Product::where('category_id', $product->category_id)->count();
        //     $serial = str_pad($nextSerialNumber, 3, '0', STR_PAD_LEFT);

        //     $product->code = "{$prefix}-{$datePart}-{$serial}";
        // }

    }
}
