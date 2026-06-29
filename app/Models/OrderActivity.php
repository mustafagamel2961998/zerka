<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Order\Status;

class OrderActivity extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'title',
        'description',
        'properties',
        'status',
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
            'properties' => 'array',
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
}