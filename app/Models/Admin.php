<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    
    protected $fillable  = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'status'
    ];

    // start relationships
        public function consultations(){
            return $this->hasMany(Consultation::class);
        }

        public function services(){
            return $this->hasMany(Service::class,'admin_id','id');
        }
    // end relationships


    // start accessors 
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }
    // end accessors 
}
