<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Country extends Model
{
     protected $fillable = [
        'currency_id',
        'iso2',
        'iso3',
        'phone_code',
        'timezone',
        'status',
     ];

    // start relationships
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id','id');
    }
    public function cities(){
        return $this->hasMany(City::class,'country_id','id');
    }
    public function translations(){
        return $this->hasMany(CountryTranslation::class,'country_id','id');
    }
    public function translation(){
        return $this->hasOne(CountryTranslation::class,'country_id','id')->where('locale',app()->getLocale());
    }
    // end relationships
    // start local scope
    public function scopeActive($query)
    {
        return $query->whereStatus('active');
    }
    protected function casts(): array
    {
        return [
            'currency_id' => 'integer',
            'status' => Status::class,
        ];
    }
}
