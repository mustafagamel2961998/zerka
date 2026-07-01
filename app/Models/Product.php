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
        'code',
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
    public function variants(){
        return $this->hasMany(ProductVariant::class,'product_id','id');
    }
    public function minVariantPrice() {
        return $this->hasOne(ProductVariant::class,'product_id','id')->ofMany([
            'price' => 'min'
        ])->select('product_variants.id', 'product_variants.product_id', 'product_variants.price');
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    // start local scope
    public function scopeActive($query){
        return $query->where('status',Status::ACTIVE);
    }
    // end local scope
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'category_id' => 'integer',
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
    public function hasSeoData(): bool
    {
        $currentTranslation = $this->currentTranslation;

        if (!$currentTranslation) {
            return false;
        }

        $fields = ['meta_title', 'meta_description'];

        foreach ($fields as $field) {
            if (!empty($currentTranslation->{$field})) {
                return true;
            }
        }

        return false;
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
