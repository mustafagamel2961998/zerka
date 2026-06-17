<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'description',
        'long_description',
        'meta_title',
        'meta_description',
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'product_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//
}
