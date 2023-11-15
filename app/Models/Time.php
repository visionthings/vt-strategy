<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable  = [
        'date_id',
        'from_time',
        'to_time',
    ];

     // start relationships
        public function date(){
            return $this->belongsTo(Date::class);
        }
    // end relationships
    
}
