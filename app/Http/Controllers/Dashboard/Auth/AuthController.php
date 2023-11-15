<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Models\Basic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        $basic = Basic::query()->first();
        return view('dashboard.auth.login',compact('basic'));
    }

    public function login(LoginRequest $request) {
          
        if(!Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('admin.login');
        }
        return redirect()->route('admin.index');
    }
}
