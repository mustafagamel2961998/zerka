<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class City extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'status',
    ];



    // start relationships
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    // end relationships

    protected function casts(): array
    {
        return [
            'country_id'=>'integer',
            'name' => 'array',
            'status' => Status::class,
        ];
    }
}
