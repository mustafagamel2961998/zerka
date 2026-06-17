<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class City extends Model
{
    protected $fillable = [
        'country_id',
        'status',
    ];


    //-----------------------------------------------------------------------------//
    // start relationships
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function translations(){
        return $this->hasMany(CityTranslation::class,'city_id','id');
    }
    public function currentTranslation(){
        return $this->hasOne(CityTranslation::class,'city_id','id')->where('locale',app()->getLocale());
    }
    // end relationships
    //-----------------------------------------------------------------------------//

    protected function casts(): array
    {
        return [
            'country_id'=>'integer',
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//

}
