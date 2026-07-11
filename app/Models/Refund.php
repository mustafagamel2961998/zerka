<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Refund\RefundStatus;
class Refund extends Model
{
     protected $fillable = [
        'order_id',
        'order_item_id',
        'quantity',
        'reason',
        'status',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
    public function item(){
        return $this->belongsTo(OrderItem::class,'order_item_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'order_id' => 'integer',
            'order_item_id' => 'integer',
            'status' => RefundStatus::class,
        ];
    }
    //-----------------------------------------------------------------------------//
}
        