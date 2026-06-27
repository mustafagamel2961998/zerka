<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'invoice_number',
        'subtotal',
        'tax_total',
        'shipping_total',
        'discount_total',
        'grand_total'
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'order_id' => 'integer',
            'user_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//
}