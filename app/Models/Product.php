<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'category_id',
        'slug',
        'status',
    ];

     //-----------------------------------------------------------------------------//
    // start relationships
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function translations(){
        return $this->hasMany(ProductTranslation::class,'product_id','id');
    }
    public function currentTranslation(){
        return $this->hasOne(ProductTranslation::class,'product_id','id')->where('locale',app()->getLocale());
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'category_id' => 'integer',
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images'); 
    }
    public function registerMediaConversions(Media $media = null): void
    {
       $this->addMediaConversion('optimized')
            ->format('webp') 
            ->quality(80)
            ->width(800)
            ->height(800)
            ->sharpen(10)
            ->performOnCollections('images');

        $this->addMediaConversion('thumb')
             ->format('webp')
             ->quality(70)
             ->width(200)
             ->height(200)
             ->performOnCollections('images');
    }
}
