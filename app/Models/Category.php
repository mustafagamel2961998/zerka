<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Enums\Status;

class Category extends Model  implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'parent_id',
        'slug',
        'status',
    ];


    //-----------------------------------------------------------------------------//
    // start relationships
    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id');
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function translations(){
        return $this->hasMany(CategoryTranslation::class,'category_id','id');
    }
    public function translation(){
        return $this->hasOne(CategoryTranslation::class,'category_id','id')->where('locale',app()->getLocale());
    }
    // end relationships
    //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'parent_id'=>'integer',
            'status' => Status::class,
        ];
    }
    //-----------------------------------------------------------------------------//
    public function hasSeoData(): bool
    {
        $currentTranslation = $this->translation;

        if (!$currentTranslation) {
            return false;
        }

        $fields = ['meta_title', 'meta_description', 'canonical_url', 'og_title'];

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
        $this->addMediaCollection('cover')
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
            ->performOnCollections('cover');

        $this->addMediaConversion('thumb')
             ->format('webp')
             ->quality(70)
             ->width(200)
             ->height(200)
             ->performOnCollections('cover');
    }
}
   