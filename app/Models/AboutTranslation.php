<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutTranslation extends Model
{
     protected $fillable = [
        'about_id',
        'locale',
        'content'
     ];


    //-----------------------------------------------------------------------------//
    // start relationships
        public function about(){
            return $this->belongsTo(About::class,'about_id','id');
        }
    // end relationships
    //-----------------------------------------------------------------------------//
}