<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
   

    //-----------------------------------------------------------------------------//
    // start relationships
     public function translations(){
        return $this->hasMany(AboutTranslation::class,'about_id','id');
     }
     public function currentTranslation(){
        return $this->hasOne(AboutTranslation::class,'about_id','id')->where('locale',app()->getLocale());
     }
    // end relationships
    //-----------------------------------------------------------------------------//
}
