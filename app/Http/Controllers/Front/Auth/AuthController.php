<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMail;
use App\Mail\UserRegister;
use App\Models\Basic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    //get user login view
    public function loginView(){
        $basic = Basic::query()->first();
        return view('auth.login',compact('basic'));
    }
    
    // login method
    public function login(Request $request){
        $request->validate([
            'email'=>['required','exists:users,email','email'],
            'password'=>['required'],
        ],
        [
            'email.required'=>'حقل البريد الالكتروني مطلوب',
            'email.exists'=>'هذا البريد غير موجود',
            'password.required'=>'حقل كلمة المرور مطلوب',    
        ]);

        $checkActive = User::where('email',$request->email)->first();
        if($checkActive->status !='active'){
            return redirect()->route('login.view')->with('faild','عفوا حسابك غير مفعل');
        }
        if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect()->route('login.view')->with('faild','حدث خطاء يرجي المحاولاة مره اخري');
        }
        return redirect()->route('index')->with('login','مرحبا بك من جديد');
    }


    //get register view
    public function registerView(){
        $basic = Basic::query()->first();
        return view('auth.register',compact('basic'));
    }

    // register method
    public function register(Request $request){
        $basic = Basic::query()->first();

        $request->validate([
            'email'=>['required','unique:users,email','email'],
            'password'=>['required','min:6','required_with:password_confirmation'],
            'phone'=>['required','unique:users,phone'],
        ],
        [
           'email.required'=>'حقل البريد الالكتروني مطلوب',
           'email.unique'=>'هذا الحساب موجود سابقا',
           'password.required'=>'حقل كلمة المرور مطلوب',
           'password.min'=>'يجب ان يكون كلمة السر علي الاقل 6 احرف',
           'password.required_with'=>'يجب ان يكون كلمات  السر متطابقه',
           'phone.required'=>'حقل رقم الهاتف مطلوب',
           'phone.unique'=>'هذا الرقم موجود سابقا' 
        ]);
        $randomCode = rand(1,958675);
        $request->merge([
            'code'=>$randomCode,
        ]);
        $user = User::create($request->all());
        // $user->mail(new UserRegister($randomCode));
        Mail::to($user->email)->send(new UserRegister($randomCode,$basic));
        $checkSesstionEmail = Session::get('email');
        if($checkSesstionEmail){
            Session::remove('email');
            Session::put('email',$user->email);
        }
        Session::put('email',$user->email);

        // Auth::login($user);
        return redirect()->route('register.active.view')->with('registerActive','تم التسجيل بنجاح وتم إرسال رمز التفعيل علي بريدك الالكتروني');

    }

    // get active view 
    public function registerActiveView(){
        $basic = Basic::query()->first();
        return view('auth.active',compact('basic'));
    }
    // active user method
    public function registerActive(Request $request){
        $getSessionEmail = Session::get('email');
        $getUser = User::where('email',$getSessionEmail)->first();
        if($getUser->code != $request->code){
            return redirect()->route('register.active.view')->with('failedCode','عفوا كود التفعيل خطاء');
        }
        $getUser->update(['status'=>'active']);
        Auth::login($getUser);
        return redirect()->route('index')->with('success','اهلا بك عزيزي العميل');
    }


    public function forgetPasswordMethod(Request $request){
        $basic = Basic::query()->first();

        $fpcode = rand(1,958675);
          $getUser = User::where('email',$request->email)->first();  
          
          if(!$getUser){
                return redirect()->route('index')->with('failed','عفوا بريدك الالكتروني غير موجود');
          }
         
          $getUser->update([
            'fp_code'=>$fpcode,
          ]);
          Mail::to($getUser->email)->send(new ForgetPasswordMail($fpcode,$basic));
          return view('auth.fpassword_code',compact('getUser'))->with('success','تم ارسال كود الاسترجاع علي بريدك الالكتروني');
    }

    public function forgetPasswordCheckCodeMethod(Request $request){
        
          $checkCode = User::where('email',$request->email)->first();
          if($checkCode->fp_code == $request->fp_code)  {
                return view('auth.new_password',compact('checkCode'));
          }
          return redirect()->back()->with('failed','عفوا الكود غير صحيح');
    }

    public function forgetPasswordUpdateMethod(Request $request){
        $request->validate([
            'password'=>['required'],
        ]);

        $updatePassword = User::where('email',$request->email)->first();
        
        $updatePassword->update([
            'password'=>Hash::make($request->password),
        ]);

        return redirect()->route('index')->with('success','تم إسترجاع كلمة المرور بنجاح');

    }
    //logout
    public function logout() {
        Auth::logout();
        return redirect()->route('index')->with('logout','تم تسجيل الخروج بنجاح');
    }
}
