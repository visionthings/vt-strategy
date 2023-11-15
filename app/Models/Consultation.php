<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable  = [
        'name',
        'admin_id',
        'price',
        'tax_price',
        'tax',
        'status',
        'order_count',
    ];

    // start relationships
        public function dates(){
            return $this->hasMany(Date::class,'consultation_id','id');
        }
        public function admin(){
            return $this->belongsTo(Admin::class);
        }
    // end relationships

}
