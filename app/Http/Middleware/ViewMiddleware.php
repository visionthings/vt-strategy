<?php

namespace App\Http\Middleware;

use App\Models\View;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class ViewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $getCookie = Cookie::get('cookie_id');
        $checkIfCookieExist = View::where('cookie_id',$getCookie)->first();
        if(!$checkIfCookieExist){
            $createRecord = View::create([
                'view'=>1,
            ]);
        }
       
        return $next($request);
    }
}
