<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Order\Status;
use App\Enums\Order\PyamentStatus;

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
        'coupon_code',
        'payment_status',
        'notes',
        'invoice_created',
        'status',
        'stock_deducted_at',
        'created_at',
        'updated_at',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class,'order_id','id');
    }
    public function activities(){
        return $this->hasMany(OrderActivity::class,'order_id','id');
    }
    public function items(){
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
    public function address(){
        return $this->hasOne(OrderAddress::class,'order_id','id');
    }
    public function invoice(){
        return $this->hasOne(Invoice::class,'order_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'payment_status' => PyamentStatus::class,
            'status' =>Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
}
        
   