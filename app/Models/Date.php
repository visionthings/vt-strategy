<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable  = [
        'consultation_id',
        'date',
        'status',
    ];

    // start relationships
        public function consultation(){
            return $this->belongsTo(Consultation::class,'consultation_id','id');
        }
        public function times(){
            return $this->hasMany(Time::class);
        }
    // end relationships
    // protected $casts = [
    //     'date' => 'datetime'
    // ];
}
