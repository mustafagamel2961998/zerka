<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Transaction\Status;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Transaction extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'order_id',
        'transaction_number',
        'payment_method',
        'amount',
        'currency',
        'payment_response',
        'status',
    ];

    //-----------------------------------------------------------------------------//
    // start relationships
    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'order_id' => 'integer',
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('screenshot')
             ->singleFile(); 
    }
    public function registerMediaConversions(Media $media = null): void
    {
       $this->addMediaConversion('optimized')
            ->format('webp') 
            ->quality(80)
            ->width(800)
            ->height(800)
            ->sharpen(10)
            ->performOnCollections('screenshot');
    }
}