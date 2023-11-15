<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Service extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable  = [
        'name',
        'admin_id',
        'description',
        'status',
        'important'
    ];

    // start relationships
        public function admin(){
            return $this->belongsTo(Admin::class,'admin_id','id');
        }
        public function contents(){
            return $this->hasMany(Content::class,'service_id','id');
        }
    // end relationships

    // protected $casts = [
    //     'name' => 'array',
    // ];

    public function registerMediaConversions(Media $media = null): void
    {
       
        $this->addMediaCollection('service')
             ->useFallbackUrl('https://www12.0zz0.com/2023/10/12/15/651893907.png')
             ->useDisk('service');
             
    }
}
