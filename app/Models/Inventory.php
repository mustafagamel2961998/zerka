<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'variant_color_id',
        'warehouse_id',
        'quantity',
        'minimum_quantity',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function variantColor(){
        return $this->belongsTo(ProductVariant::class,'variant_color_id','id');
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'variant_color_id' => 'integer',
            'warehouse_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//
}
           