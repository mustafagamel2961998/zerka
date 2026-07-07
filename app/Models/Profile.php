<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
     protected $primaryKey = 'user_id';
     protected $fillable = [
        'user_id',
        'country_id',
        'city_id',
        'first_name',
        'last_name',
    ];

    // start relationships
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id','id');
    }
    // end relationships

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'country_id'=>'integer',
            'city_id'=>'integer',
        ];
    }

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
          