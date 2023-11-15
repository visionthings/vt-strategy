<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class About extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;


    protected $fillable  = [
        'short_text',
        'content',
    ];




    public function registerMediaConversions(Media $media = null): void
    {
       
        $this->addMediaCollection('about')
             ->useFallbackUrl('https://www12.0zz0.com/2023/10/12/15/651893907.png')
             ->useDisk('about');
             
    }
}
