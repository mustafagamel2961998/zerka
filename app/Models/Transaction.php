<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Transaction\Status;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'transaction_number',
        'payment_method',
        'amount',
        'currency',
        'payment_response',
        'status',
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'order_id' => 'integer',
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//

}