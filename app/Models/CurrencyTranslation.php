<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyTranslation extends Model
{
    protected $table = 'currency_translations';
    protected $fillable = [
        'currency_id',
        'locale',
        'name',
        'symbol',
    ];
    // start relationships
    
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'currency_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//
}
