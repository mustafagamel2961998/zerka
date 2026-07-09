<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    protected $fillable = [
        'setting_id',
        'locale',
        'name',
    ];


    //-----------------------------------------------------------------------------//
    // start relationships
    public function setting(){
        return $this->belongsTo(Setting::class,'setting_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'setting_id' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//
}
