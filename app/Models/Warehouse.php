<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Warehouse extends Model
{
    protected $fillable = [
        'country_id',
        'city_id',
        'code',
        'phone',
        'street_details',
        'status',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    public function translations(){
        return $this->hasMany(WarehouseTranslation::class,'warehouse_id','id');
    }
    public function currentTranslation(){
        return $this->hasOne(WarehouseTranslation::class,'warehouse_id','id')->where('locale',app()->getLocale());
    }
    // end relationships
    //-----------------------------------------------------------------------------//

    protected function casts(): array
    {
        return [
            'country_id'=>'integer',
            'city_id'=>'integer',
            'status' => Status::class,
        ];
    }
}