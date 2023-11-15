<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/bootstrap.rtl.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/mainstyle.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/auth/login.css')}}">
   
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>إسترجاع كلمة السر  </title>
</head>
<body>
            
  @if(Session::get('faild'))
  <div class="erroralert ">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      {{$message = Session::get('faild')}}
  </div>
  @endif
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <div class="login">
            <!-- Tabs Titles -->
            <h2 class="active"> إسترجاع كلمة السر  </h2>
        
            <!-- Icon -->
            <a class="fadeIn first d-block" href="/">
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" id="icon" class="" alt="رؤية الاشياء للإستشارات" />
            </a>
            <!-- Login Form -->
            <form id="loginForm" action="{{route('forget.password.update')}}" method="POST" novalidate>
                @csrf
                @error('email')
                  <p class="alert alert-danger">{{$message}}</p>
                @enderror
                <input type="hidden" id="email" class="fadeIn second" name="email" value="{{$checkCode->email}}"  required>

                <input type="password" id="password" class="fadeIn third " name="password" placeholder="كلمة المرور" required>

                {{-- <input type="password" id="password" class="fadeIn third " name="password_confirmation" placeholder="تأكيد كلمة المرور" required> --}}

                <input type="submit" class="fadeIn fourth" value="إرسال كود التفعيل">
            </form>
        
            <!-- Remind Passowrd -->
            <div class="formFooter" id="loginfooter">
                <a class="underlineHover" href="/register">مستخدم جديد</a>
            </div>
          </div>
        </div>
      </div>

    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/dashboard/login.js')}}"></script>
</body>
</html>