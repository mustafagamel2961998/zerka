<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Size extends Model
{
    protected $fillable = [
        'size',
        'status',
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
    public function variants(){
        return $this->hasMany(ProductVariant::class,'product_id','id');
    }  
    // end relationships
    //-----------------------------------------------------------------------------//
    // start local scope
    public function scopeActive($query){
        return $query->where('status',Status::ACTIVE);
    }
    // end local scope
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//

}
