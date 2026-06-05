<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    protected $table = 'country_translations';
    protected $fillable = [
        'country_id',
        'locale',
        'name'
    ];

    // start relationships
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    // end relationships
}
