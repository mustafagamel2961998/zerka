<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $fillable = [
        'category_id',
        'locale',
        'name',
        'description',
        'meta_title',
        'meta_description'
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'category_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//
}
       