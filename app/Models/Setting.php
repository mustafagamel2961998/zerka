<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'currency_id',
        'phone',
        'email',
        'tax_percentage',
        'shipping_amount',
        'timezone',
    ];
    //-----------------------------------------------------------------------------//
    // start relationships
    public function translations(){
        return $this->hasMany(SettingTranslation::class,'setting_id','id');
    }
    public function currentTranslation(){
        return $this->hasOne(SettingTranslation::class,'setting_id','id')->where('locale',app()->getLocale());
    }
    // end relationships
    //-----------------------------------------------------------------------------//
   //-----------------------------------------------------------------------------//
    protected function casts(): array
    {
        return [
            'currency_id' => 'integer',
            'tax_percentage' => 'integer',
        ];
    }
    //-----------------------------------------------------------------------------//
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
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
            ->performOnCollections('logo');

        $this->addMediaConversion('thumb')
             ->format('webp')
             ->quality(70)
             ->width(200)
             ->height(200)
             ->performOnCollections('logo');
    }
}
