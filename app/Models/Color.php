<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Color extends Model
{   
    protected $fillable = [
        'code',
        'status',
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
        public function variantColors(){
            return $this->hasMany(VariantColor::class,'color_id','id');
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
