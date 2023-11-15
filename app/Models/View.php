<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'cookie_id',
        'view',
    ];

    // start observe
    public static function booted() {
        static::creating(function(View $view){
            $view->cookie_id = View::getCookieId();
        });
    }
    //end observe

    protected static function getCookieId()
    {
        $cookie_id = Cookie::get('cookie_id');
        if (!$cookie_id) {
                $cookie_id = Str::uuid();
                Cookie::queue('cookie_id', $cookie_id,60*24);
        }
        return $cookie_id;
    }
}
