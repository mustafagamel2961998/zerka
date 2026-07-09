<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
     protected $fillable = [
        'order_id',
        'name',
        'country',
        'city',
        'phone',
        'street_details',
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
        ];
    }
    //-----------------------------------------------------------------------------//
}
