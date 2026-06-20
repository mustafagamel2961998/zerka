<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class ProductVariant extends Model
{
    
    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'price',
        'sku',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function size(){
        return $this->belongsTo(Size::class,'size_id','id');
    }
    public function color(){
        return $this->belongsTo(Color::class,'color_id','id');
    }
    public function inventories(){
        return $this->hasMany(Inventory::class,'product_variant_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'product_id' => 'integer',
            'size_id' => 'integer',
            'color_id' => 'integer',
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
}
