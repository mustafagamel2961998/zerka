<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Order\Status;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'tax_total',
        'shipping_total',
        'discount_total',
        'grand_total',
        'currency',
        'coupon_code',
        'notes',
        'status',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'status' =>Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
}
        
   