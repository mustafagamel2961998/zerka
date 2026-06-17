<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseTranslation extends Model
{
     protected $fillable = [
        'warehouse_id',
        'locale',
        'name',
        'description',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//

    protected function casts(): array
    {
        return [
            'warehouse_id'=>'integer',
        ];
    }
}
   

   