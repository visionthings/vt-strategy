<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/bootstrap.rtl.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/mainstyle.css')}}">
    <link rel="stylesheet" href="{{asset(env('APP_ASSETS').'/'.'assets/css/dashboard/auth/login.css')}}">
    
    <link rel="icon" href="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" type="image/png">
    <title>تسجيل الدخول</title>
</head>
<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <div class="login">
            <!-- Tabs Titles -->
            <h2 class="active"> تسجيل الدخول </h2>
        
            <!-- Icon -->
            <a class="fadeIn first d-block" href="/">
                <img src="{{asset(env('APP_ASSETS').'/'.'assets/images/new.png')}}" id="icon" class="" alt="رؤية الاشياء للإستشارات" />
            </a>
            <!-- Login Form -->
            <form id="loginForm" action="{{route('admin.login')}}" method="POST" novalidate>
                @csrf
               
               
                <input type="email" id="email" class="fadeIn second  @error('email') error @enderror" name="email" placeholder="البريد الإلكتروني" required>
              
               

                <input type="password" id="password" class="fadeIn third @error('password') error @enderror" name="password" placeholder="كلمة المرور" required>
                <input type="submit" class="fadeIn fourth" value="تسجيل الدخول">
            </form>
        
            {{-- <!-- Remind Passowrd -->
            <div class="formFooter" id="loginfooter">
                <a class="underlineHover" href="/register">مستخدم جديد</a>
                <a class="underlineHover" href="#">نسيت كلمة السر؟</a>
            </div> --}}
          </div>
        </div>
      </div>

    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/jquery.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/fontawesome/js/all.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset(env('APP_ASSETS').'/'.'assets/js/dashboard/login.js')}}"></script>
</body>
</html>