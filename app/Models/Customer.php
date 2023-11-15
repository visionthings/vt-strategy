<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Customer extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable  = [
        'name',
        'rate',
        'job_name',
        'comment',
        'status',
        'consultation_id',
    ];

    //start realtionships
    public function consultion(){
        return $this->belongsTo(Consultation::class);
    }
    // end relationships
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaCollection('customer')
                ->useFallbackUrl('https://freepngimg.com/thumb/customer/1-2-customer-transparent.png')
                ->useDisk('customer');
    }


}
