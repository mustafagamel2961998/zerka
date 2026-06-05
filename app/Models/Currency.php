<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Currency extends Model
{

     protected $fillable = [
        'code',
        'exchange_rate',
        'decimal_places',
        'status',
     ];

    // start relationships
    public function countries(){
        return $this->hasMany(Country::class,'currency_id','id');
    }
    public function translations(){
        return $this->hasMany(CurrencyTranslation::class,'currency_id','id');
    }
    public function translation(){
        return $this->hasOne(CurrencyTranslation::class,'currency_id','id')->where('locale',app()->getLocale());
    }
    // end relationships

    protected function casts(): array
    {
        return [
            'status' =>Status::class,
        ];
    }
}
