<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderActivity extends Model
{
      protected $fillable = [
        'order_id',
        'user_id',
        'description',
        'properties',
        'status_key',
        
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