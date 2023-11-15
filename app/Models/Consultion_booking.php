<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultion_booking extends Model
{
    use HasFactory;
    protected $fillable  = [
        'user_id',
        'consultion_id',
        'name',
        'phone',
        'email',
        'payment_status',
        'from_time',
        'to_time',
        'meeting_link',
        'status',
    ];

    //start realtionship
    public function consultion(){
        return $this->belongsTo(Consultation::class);
    }
    // end realtionship
}
