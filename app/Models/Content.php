<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Content extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable  = [
        'service_id',
        'title',
        'slug',
        'intro',
        'content',
        'yt_video',
        'status'
    ];
    // start relationships
        public function service(){
            return $this->belongsTo(Service::class,'service_id','id');
        }
    // end relationships

    public function registerMediaConversions(Media $media = null): void
    {
       
        $this->addMediaCollection('content')
        ->useFallbackUrl('https://app.advaiet.com/item_dfile/default_product.png')
        ->useDisk('content');
    }

    // protected $casts = [
    //     'title' => 'array',
    //     'content' => 'array',
    // ];
}
