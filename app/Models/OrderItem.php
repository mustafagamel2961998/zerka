<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Order\Status;

class OrderItem extends Model
{
  
    protected $fillable = [
        'order_id',
        'product_id',
        'variant_color_id',
        'quantity',
        'price',
        'total',
        'attributes',
        'status',
        'created_at',
        'updated_at',
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function color(){
        return $this->belongsTo(VariantColor::class,'variant_color_id','id');
    }
    public function refunds(){
        return $this->hasMany(Refund::class, 'order_item_id', 'id');
    }


    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'order_id' => 'integer',
            'product_id' => 'integer',
            'product_variant_id' => 'integer',
            'quantity' => 'integer',
            'attributes' => 'array',
            'status' =>Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
    public function getRefundableQuantityAttribute(): int
    {
        $alreadyRequested = $this->refunds()
            ->whereIn('status', [
                \App\Enums\Refund\RefundStatus::PENDING,
                \App\Enums\Refund\RefundStatus::APPROVED,
            ])
            ->sum('quantity');

        return max(0, $this->quantity - $alreadyRequested);
    }
}
