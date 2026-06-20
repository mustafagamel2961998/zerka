<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_variant_id',
        'warehouse_id',
        'quantity',
        'minimum_quantity',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function variants(){
        return $this->belongsTo(ProductVariant::class,'product_variant_id','id');
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'product_variant_id' => 'integer',
            'warehouse_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//
}
           