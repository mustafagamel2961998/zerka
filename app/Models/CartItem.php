<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_color_id',
        'size',
        'color',
        'quantity',
        'price',
        'total'
    ];
 
    //-----------------------------------------------------------------------------//
    // start relationships
    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function color(){
        return $this->belongsTo(VariantColor::class,'variant_color_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'cart_id'=>'integer',
            'product_id' => 'integer',
            'variant_color_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//

}
  