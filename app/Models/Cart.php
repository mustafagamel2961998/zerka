<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'coupon_id',
        'subtotal',
        'tax_total',
        'shipping_total',
        'discount_total',
        'grand_total'
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class,'coupon_id','id');
    }
    public function items(){
        return $this->hasMany(CartItem::class,'cart_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'user_id'=>'integer',
            'coupon_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//

    
}
