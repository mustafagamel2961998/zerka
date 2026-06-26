<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Size extends Model
{
    protected $fillable = [
        'size',
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
