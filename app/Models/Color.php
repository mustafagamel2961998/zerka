<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Color extends Model
{   
    protected $fillable = [
        'code',
        'status',
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
    
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//

}
