<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantColor extends Model
{
      protected $fillable = [
        'product_variant_id',
        'color_id',
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
        public function variant(){
            return $this->belongsTo(ProductVariant::class,'product_variant_id','id');
        }
        public function color(){
            return $this->belongsTo(Color::class,'color_id','id');
        }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'product_variant_id' => 'integer',
            'color_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//

}
