<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     protected $fillable = [
        'name',
        'status',
    ];


    // start relationships
    public function city(){
        return $this->hasMany(City::class,'country_id','id');
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
            'name' => 'array',
            'status' => Status::class,
        ];
    }
}
