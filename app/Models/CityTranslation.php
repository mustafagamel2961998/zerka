<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    protected $table = 'city_translations';
    protected $fillable = [
        'city_id',
        'locale',
        'name',
    ];

    // start relationships
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    // end relationships
}