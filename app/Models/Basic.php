<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Basic extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable  = [
        'name',
        'description',
        'phone',
        'whatsapp',
        'email',
        'address',
        'facebook',
        'instagram',
        'snapchat',
        'linkedin',
        'twitter'
    ];


    
    public function registerMediaConversions(Media $media = null): void
    {
       
        $this->addMediaCollection('logo')
             ->useFallbackUrl('https://app.advaiet.com/item_dfile/default_product.png')
             ->useDisk('basic');
             
        $this->addMediaCollection('icon')
             ->useFallbackUrl('https://app.advaiet.com/item_dfile/default_product.png')
             ->useDisk('basic');     
    }
  
}
