<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\Status;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable,InteractsWithMedia,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'country_id',
        'email',
        'phone',
        'password',
        'status',
    ];


    // start relationships
        public function profile(){
            return $this->hasOne(Profile::class,'user_id','id');
        }
        public function country(){
            return $this->belongsTo(Country::class,'country_id','id');
        }
    // end relationships

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => Status::class,
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
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
            ->performOnCollections('avatar');

        $this->addMediaConversion('thumb')
             ->format('webp')
             ->quality(70)
             ->width(200)
             ->height(200)
             ->performOnCollections('avatar');
    }
}
